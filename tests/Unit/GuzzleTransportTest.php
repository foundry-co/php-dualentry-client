<?php

namespace FoundryCo\DualEntry\Tests\Unit;

use FoundryCo\DualEntry\Exceptions\AuthenticationException;
use FoundryCo\DualEntry\Exceptions\NotFoundException;
use FoundryCo\DualEntry\Exceptions\RateLimitException;
use FoundryCo\DualEntry\Exceptions\ValidationException;
use FoundryCo\DualEntry\Transport\GuzzleTransport;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Middleware;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

final class GuzzleTransportTest extends TestCase
{
    private function makeTransport(array $responses, int $maxRetries = 0, array &$history = []): GuzzleTransport
    {
        $mock = new MockHandler($responses);
        $stack = HandlerStack::create($mock);
        $stack->push(Middleware::history($history));

        $client = new Client([
            'base_uri' => GuzzleTransport::PRODUCTION_BASE_URI,
            'handler' => $stack,
            'headers' => ['X-API-KEY' => 'org_production_testkey1234'],
        ]);

        return new GuzzleTransport($client, $maxRetries);
    }

    public function test_sends_api_key_header_and_decodes_json(): void
    {
        $history = [];
        $transport = $this->makeTransport([
            new Response(200, ['Content-Type' => 'application/json'], json_encode([['id' => 1]])),
        ], history: $history);

        $result = $transport->request('GET', 'invoices/');

        self::assertSame([['id' => 1]], $result);
        self::assertSame('org_production_testkey1234', $history[0]['request']->getHeaderLine('X-API-KEY'));
        self::assertSame('/public/v2/invoices/', $history[0]['request']->getUri()->getPath());
    }

    public function test_query_parameters_are_sent(): void
    {
        $history = [];
        $transport = $this->makeTransport([
            new Response(200, [], json_encode([])),
        ], history: $history);

        $transport->request('GET', 'invoices/', query: ['limit' => 10, 'offset' => 20]);

        parse_str($history[0]['request']->getUri()->getQuery(), $query);
        self::assertSame(['limit' => '10', 'offset' => '20'], $query);
    }

    public function test_write_requests_get_an_idempotency_key_by_default(): void
    {
        $history = [];
        $transport = $this->makeTransport([
            new Response(201, [], json_encode(['id' => 1])),
        ], history: $history);

        $transport->request('POST', 'invoices/', json: ['memo' => 'test'], idempotent: true);

        self::assertNotEmpty($history[0]['request']->getHeaderLine('Idempotency-Key'));
    }

    public function test_get_requests_do_not_get_an_idempotency_key(): void
    {
        $history = [];
        $transport = $this->makeTransport([
            new Response(200, [], json_encode([])),
        ], history: $history);

        $transport->request('GET', 'invoices/');

        self::assertSame('', $history[0]['request']->getHeaderLine('Idempotency-Key'));
    }

    public function test_401_maps_to_authentication_exception(): void
    {
        $transport = $this->makeTransport([
            new Response(401, [], json_encode([
                'success' => false,
                'errors' => ['__all__' => ['API key authentication failed']],
            ])),
        ]);

        $this->expectException(AuthenticationException::class);

        try {
            $transport->request('GET', 'invoices/');
        } catch (AuthenticationException $exception) {
            self::assertSame(['API key authentication failed'], $exception->getGeneralErrors());

            throw $exception;
        }
    }

    public function test_404_maps_to_not_found_exception(): void
    {
        $transport = $this->makeTransport([
            new Response(404, [], json_encode(['success' => false, 'errors' => []])),
        ]);

        $this->expectException(NotFoundException::class);

        $transport->request('GET', 'invoices/999999/');
    }

    public function test_422_maps_to_validation_exception_with_field_errors(): void
    {
        $transport = $this->makeTransport([
            new Response(422, [], json_encode([
                'success' => false,
                'errors' => ['customer_id' => ['This field is required.']],
            ])),
        ]);

        try {
            $transport->request('POST', 'invoices/', json: []);
            self::fail('Expected a ValidationException');
        } catch (ValidationException $exception) {
            self::assertSame(['This field is required.'], $exception->getFieldErrors('customer_id'));
        }
    }

    public function test_429_maps_to_rate_limit_exception_with_retry_after(): void
    {
        $transport = $this->makeTransport([
            new Response(429, ['Retry-After' => '5'], json_encode([
                'success' => false,
                'errors' => ['__all__' => ['Too many requests.']],
            ])),
        ]);

        try {
            $transport->request('GET', 'invoices/');
            self::fail('Expected a RateLimitException');
        } catch (RateLimitException $exception) {
            self::assertSame(5, $exception->getRetryAfterSeconds());
        }
    }

    public function test_retries_429_and_succeeds(): void
    {
        $history = [];
        $transport = $this->makeTransport([
            new Response(429, ['Retry-After' => '0'], json_encode(['success' => false, 'errors' => []])),
            new Response(200, [], json_encode(['id' => 1])),
        ], maxRetries: 1, history: $history);

        $result = $transport->request('GET', 'invoices/1/');

        self::assertSame(['id' => 1], $result);
        self::assertCount(2, $history);
    }

    public function test_rate_limit_headers_are_captured(): void
    {
        $transport = $this->makeTransport([
            new Response(200, [
                'X-RateLimit-Limit' => '50',
                'X-RateLimit-Remaining' => '37',
                'X-RateLimit-Reset' => '1700000000',
            ], json_encode([])),
        ]);

        $transport->request('GET', 'invoices/');
        $rateLimit = $transport->getLastRateLimit();

        self::assertSame(50, $rateLimit->limit);
        self::assertSame(37, $rateLimit->remaining);
        self::assertSame(1700000000, $rateLimit->resetAt);
    }
}
