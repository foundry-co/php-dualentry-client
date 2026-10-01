<?php

namespace FoundryCo\DualEntry\Transport;

use FoundryCo\DualEntry\Exceptions\ApiException;
use FoundryCo\DualEntry\Exceptions\AuthenticationException;
use FoundryCo\DualEntry\Exceptions\ConflictException;
use FoundryCo\DualEntry\Exceptions\NotFoundException;
use FoundryCo\DualEntry\Exceptions\RateLimitException;
use FoundryCo\DualEntry\Exceptions\ServerException;
use FoundryCo\DualEntry\Exceptions\TransportException;
use FoundryCo\DualEntry\Exceptions\ValidationException;
use FoundryCo\DualEntry\Support\RateLimitInfo;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\RequestOptions;
use JsonException;
use Psr\Http\Message\ResponseInterface;
use Ramsey\Uuid\Uuid;

/**
 * Sends requests to the DualEntry public API over Guzzle, applying auth,
 * idempotency keys, rate-limit bookkeeping, retries, and error mapping.
 */
final class GuzzleTransport implements Transport
{
    public const PRODUCTION_BASE_URI = 'https://api.dualentry.com';

    public const DEVELOPMENT_BASE_URI = 'https://api-dev.dualentry.com';

    private const WRITE_METHODS = ['POST', 'PUT', 'PATCH', 'DELETE'];

    private ?RateLimitInfo $lastRateLimit = null;

    public function __construct(
        private readonly ClientInterface $httpClient,
        private readonly int $maxRetries = 2,
        private readonly bool $autoIdempotencyKeys = true,
    ) {}

    public static function make(
        string $apiKey,
        string $baseUri = self::PRODUCTION_BASE_URI,
        float $timeout = 30.0,
        int $maxRetries = 2,
        bool $autoIdempotencyKeys = true,
        array $guzzleOptions = [],
    ): self {
        $client = new Client(array_merge([
            'base_uri' => rtrim($baseUri, '/'),
            'timeout' => $timeout,
            'headers' => [
                'X-API-KEY' => $apiKey,
                'Accept' => 'application/json',
            ],
        ], $guzzleOptions));

        return new self($client, $maxRetries, $autoIdempotencyKeys);
    }

    public function request(
        string $method,
        string $path,
        array $query = [],
        ?array $json = null,
        ?array $multipart = null,
        array $headers = [],
        bool $idempotent = false,
    ): array {
        $method = strtoupper($method);
        $options = [];

        if ($query !== []) {
            $options[RequestOptions::QUERY] = $this->normalizeQuery($query);
        }

        if ($multipart !== null) {
            $options[RequestOptions::MULTIPART] = $multipart;
        } elseif ($json !== null) {
            $options[RequestOptions::JSON] = $json;
        }

        if ($idempotent && in_array($method, self::WRITE_METHODS, true) && $this->autoIdempotencyKeys) {
            $headers['Idempotency-Key'] ??= Uuid::uuid4()->toString();
        }

        if ($headers !== []) {
            $options[RequestOptions::HEADERS] = $headers;
        }

        $uri = '/public/v2/'.ltrim($path, '/');

        $attempt = 0;

        while (true) {
            try {
                $response = $this->httpClient->request($method, $uri, $options);
                $this->lastRateLimit = RateLimitInfo::fromResponse($response);

                return $this->decode($response);
            } catch (RequestException $exception) {
                $response = $exception->getResponse();

                if ($response === null) {
                    throw new TransportException(
                        "DualEntry request failed: {$exception->getMessage()}",
                        0,
                        $exception,
                    );
                }

                $this->lastRateLimit = RateLimitInfo::fromResponse($response);
                $status = $response->getStatusCode();

                if ($this->shouldRetry($status, $attempt)) {
                    $attempt++;
                    usleep($this->retryDelayMicroseconds($response, $attempt));

                    continue;
                }

                throw $this->toApiException($response);
            } catch (GuzzleException $exception) {
                throw new TransportException(
                    "DualEntry request failed: {$exception->getMessage()}",
                    0,
                    $exception,
                );
            }
        }
    }

    public function getLastRateLimit(): ?RateLimitInfo
    {
        return $this->lastRateLimit;
    }

    private function shouldRetry(int $status, int $attempt): bool
    {
        if ($attempt >= $this->maxRetries) {
            return false;
        }

        return $status === 429 || $status >= 500;
    }

    private function retryDelayMicroseconds(ResponseInterface $response, int $attempt): int
    {
        $retryAfter = $response->getHeaderLine('Retry-After');

        if ($retryAfter !== '' && is_numeric($retryAfter)) {
            return (int) ((float) $retryAfter * 1_000_000);
        }

        // Exponential backoff fallback: 200ms, 400ms, 800ms...
        return (int) (200_000 * (2 ** ($attempt - 1)));
    }

    private function normalizeQuery(array $query): array
    {
        $normalized = [];

        foreach ($query as $key => $value) {
            if ($value === null) {
                continue;
            }

            if (is_bool($value)) {
                $value = $value ? 'true' : 'false';
            }

            $normalized[$key] = $value;
        }

        return $normalized;
    }

    private function decode(ResponseInterface $response): array
    {
        $body = (string) $response->getBody();

        if ($body === '') {
            return [];
        }

        try {
            return json_decode($body, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new TransportException(
                "DualEntry returned a response that could not be decoded as JSON: {$exception->getMessage()}",
                0,
                $exception,
            );
        }
    }

    private function toApiException(ResponseInterface $response): ApiException
    {
        $status = $response->getStatusCode();
        $body = [];

        try {
            $raw = (string) $response->getBody();
            $body = $raw === '' ? [] : json_decode($raw, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            // Fall through with an empty body; some error responses (e.g. gateway timeouts) aren't JSON.
        }

        $errors = is_array($body['errors'] ?? null) ? $body['errors'] : [];
        $errorCode = $body['error_code'] ?? null;
        $errorReason = $body['error_reason'] ?? null;
        $message = $this->summarizeError($status, $errors, $errorReason);

        return match (true) {
            $status === 401, $status === 403 => new AuthenticationException($message, $status, $errors, $errorCode, $errorReason, $body),
            $status === 404 => new NotFoundException($message, $status, $errors, $errorCode, $errorReason, $body),
            $status === 409 => new ConflictException($message, $status, $errors, $errorCode, $errorReason, $body, $this->retryAfterSeconds($response)),
            $status === 400, $status === 402, $status === 422 => new ValidationException($message, $status, $errors, $errorCode, $errorReason, $body),
            $status === 429 => new RateLimitException($message, $status, $errors, $errorCode, $errorReason, $body, $this->retryAfterSeconds($response), $this->lastRateLimit),
            $status >= 500 => new ServerException($message, $status, $errors, $errorCode, $errorReason, $body),
            default => new ApiException($message, $status, $errors, $errorCode, $errorReason, $body),
        };
    }

    private function retryAfterSeconds(ResponseInterface $response): ?int
    {
        $value = $response->getHeaderLine('Retry-After');

        return $value === '' ? null : (int) $value;
    }

    private function summarizeError(int $status, array $errors, ?string $errorReason): string
    {
        $messages = $errors['__all__'] ?? [];

        foreach ($errors as $field => $fieldMessages) {
            if ($field === '__all__') {
                continue;
            }

            foreach ((array) $fieldMessages as $fieldMessage) {
                $messages[] = "{$field}: {$fieldMessage}";
            }
        }

        if ($messages !== []) {
            return implode('; ', $messages);
        }

        return $errorReason ?? "DualEntry API request failed with status {$status}";
    }
}
