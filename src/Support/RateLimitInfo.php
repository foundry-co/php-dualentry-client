<?php

namespace FoundryCo\DualEntry\Support;

use Psr\Http\Message\ResponseInterface;

/**
 * Snapshot of the `X-RateLimit-*` headers from the most recent response, as
 * documented at
 * https://docs.dualentry.com/developers/guides/api/core-concepts/rate-limiting
 *
 * Reflects whichever of the aggregate or per-endpoint buckets is tighter.
 */
final class RateLimitInfo
{
    public function __construct(
        public readonly ?int $limit,
        public readonly ?int $remaining,
        public readonly ?int $resetAt,
        public readonly ?int $retryAfter = null,
    ) {}

    public static function fromResponse(ResponseInterface $response): self
    {
        return new self(
            limit: self::header($response, 'X-RateLimit-Limit'),
            remaining: self::header($response, 'X-RateLimit-Remaining'),
            resetAt: self::header($response, 'X-RateLimit-Reset'),
            retryAfter: self::header($response, 'Retry-After'),
        );
    }

    private static function header(ResponseInterface $response, string $name): ?int
    {
        $value = $response->getHeaderLine($name);

        return $value === '' ? null : (int) $value;
    }
}
