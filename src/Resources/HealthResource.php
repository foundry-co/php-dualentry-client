<?php

namespace FoundryCo\DualEntry\Resources;

/**
 * API health check.
 */
final class HealthResource extends AbstractResource
{
    protected string $basePath = 'health/';

    public function check(): array
    {
        return $this->transport->request('GET', $this->basePath);
    }
}
