<?php

namespace FoundryCo\DualEntry\Exceptions;

use Throwable;

/**
 * Thrown whenever the DualEntry API returns a non-2xx response.
 *
 * Carries the decoded error envelope documented at
 * https://docs.dualentry.com/developers/guides/api/core-concepts/errors
 *
 * {
 *   "success": false,
 *   "errors": {"<field_name|__all__>": ["message", ...]},
 *   "error_code": "period_locked",
 *   "error_reason": "..."
 * }
 */
class ApiException extends DualEntryException
{
    public function __construct(
        string $message,
        private readonly int $statusCode,
        private readonly array $errors = [],
        private readonly ?string $errorCode = null,
        private readonly ?string $errorReason = null,
        private readonly array $responseBody = [],
        ?Throwable $previous = null,
    ) {
        parent::__construct($message, $statusCode, $previous);
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Non-field-specific error messages (the "__all__" bucket).
     */
    public function getGeneralErrors(): array
    {
        return $this->errors['__all__'] ?? [];
    }

    public function getFieldErrors(string $field): array
    {
        return $this->errors[$field] ?? [];
    }

    public function getErrorCode(): ?string
    {
        return $this->errorCode;
    }

    public function getErrorReason(): ?string
    {
        return $this->errorReason;
    }

    /**
     * The full decoded JSON response body, when available.
     */
    public function getResponseBody(): array
    {
        return $this->responseBody;
    }
}
