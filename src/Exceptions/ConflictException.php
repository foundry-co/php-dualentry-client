<?php

namespace FoundryCo\DualEntry\Exceptions;

/**
 * 409 — an in-flight request is already using this Idempotency-Key, or the
 * key's stored response cannot be replayed. Retry after the duration given
 * by {@see self::getRetryAfterSeconds()}.
 */
class ConflictException extends ApiException
{
    public function __construct(
        string $message,
        int $statusCode,
        array $errors = [],
        ?string $errorCode = null,
        ?string $errorReason = null,
        array $responseBody = [],
        private readonly ?int $retryAfterSeconds = null,
    ) {
        parent::__construct($message, $statusCode, $errors, $errorCode, $errorReason, $responseBody);
    }

    public function getRetryAfterSeconds(): ?int
    {
        return $this->retryAfterSeconds;
    }
}
