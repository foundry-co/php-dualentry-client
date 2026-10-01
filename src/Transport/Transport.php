<?php

namespace FoundryCo\DualEntry\Transport;

use FoundryCo\DualEntry\Support\RateLimitInfo;

interface Transport
{
    public function request(
        string $method,
        string $path,
        array $query = [],
        ?array $json = null,
        ?array $multipart = null,
        array $headers = [],
        bool $idempotent = false,
    ): array;

    public function getLastRateLimit(): ?RateLimitInfo;
}
