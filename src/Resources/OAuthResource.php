<?php

namespace FoundryCo\DualEntry\Resources;

/**
 * OAuth flow endpoints, for integrations that authenticate on behalf of a
 * DualEntry user rather than with a static API key.
 */
final class OAuthResource extends AbstractResource
{
    protected string $basePath = 'oauth/';

    public function authorize(array $payload): array
    {
        return $this->transport->request('POST', $this->basePath.'authorize/', json: $payload);
    }

    public function callback(array $query = []): array
    {
        return $this->transport->request('GET', $this->basePath.'callback/', query: $query);
    }

    /**
     * Exchange an authorization code (or refresh token) for an access token.
     */
    public function token(array $payload): array
    {
        return $this->transport->request('POST', $this->basePath.'token/', json: $payload);
    }
}
