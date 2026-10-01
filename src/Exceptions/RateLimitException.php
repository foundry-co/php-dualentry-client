<?php

namespace FoundryCo\DualEntry\Exceptions;

use FoundryCo\DualEntry\Support\RateLimitInfo;

/**
 * 429 — the aggregate or per-endpoint token bucket is empty. See
 * https://docs.dualentry.com/developers/guides/api/core-concepts/rate-limiting
 */
class RateLimitException extends ApiException
{
    public function __construct(
        string $message,
        int $statusCode,
        array $errors = [],
        ?string $errorCode = null,
        ?string $errorReason = null,
        array $responseBody = [],
        private readonly ?int $retryAfterSeconds = null,
        private readonly ?RateLimitInfo $rateLimit = null,
    ) {
        parent::__construct($message, $statusCode, $errors, $errorCode, $errorReason, $responseBody);
    }

    public function getRetryAfterSeconds(): ?int
    {
        return $this->retryAfterSeconds;
    }

    public function getRateLimit(): ?RateLimitInfo
    {
        return $this->rateLimit;
    }
}
