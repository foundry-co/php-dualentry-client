<?php

use FoundryCo\DualEntry\Transport\GuzzleTransport;

return [
    /*
    |--------------------------------------------------------------------------
    | API Key
    |--------------------------------------------------------------------------
    |
    | Issued from DualEntry's API Keys settings page. Looks like
    | org_production_********XXXX, even for sandbox organizations.
    |
    */
    'api_key' => env('DUALENTRY_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Base URI
    |--------------------------------------------------------------------------
    */
    'base_uri' => env('DUALENTRY_BASE_URI', GuzzleTransport::PRODUCTION_BASE_URI),

    /*
    |--------------------------------------------------------------------------
    | Timeout (seconds)
    |--------------------------------------------------------------------------
    */
    'timeout' => (float) env('DUALENTRY_TIMEOUT', 30.0),

    /*
    |--------------------------------------------------------------------------
    | Max Retries
    |--------------------------------------------------------------------------
    |
    | Automatic retries, with backoff honoring any `Retry-After` header, for
    | 429 and 5xx responses.
    |
    */
    'max_retries' => (int) env('DUALENTRY_MAX_RETRIES', 2),

    /*
    |--------------------------------------------------------------------------
    | Automatic Idempotency Keys
    |--------------------------------------------------------------------------
    |
    | When true, a UUIDv4 Idempotency-Key is generated automatically for
    | every write request that doesn't already specify one. See
    | https://docs.dualentry.com/developers/guides/api/core-concepts/idempotency-and-write-validation
    |
    */
    'auto_idempotency_keys' => (bool) env('DUALENTRY_AUTO_IDEMPOTENCY_KEYS', true),

    /*
    |--------------------------------------------------------------------------
    | Additional Guzzle Options
    |--------------------------------------------------------------------------
    |
    | Merged into the underlying Guzzle client, e.g. 'proxy', 'verify',
    | 'debug', or a 'handler' for testing.
    |
    */
    'guzzle' => [],
];
