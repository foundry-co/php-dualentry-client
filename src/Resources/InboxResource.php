<?php

namespace FoundryCo\DualEntry\Resources;

/**
 * The document inbox: unprocessed records and transactions awaiting review.
 * Read-only through the public API.
 */
final class InboxResource extends AbstractResource
{
    protected string $basePath = 'inbox/';

    /**
     * Inbox overview/summary.
     */
    public function overview(): array
    {
        return $this->transport->request('GET', $this->basePath);
    }

    public function records(array $query = []): array
    {
        $response = $this->transport->request('GET', $this->basePath.'records/', query: $query);

        return $response['items'] ?? [];
    }

    public function record(int|string $recordId): array
    {
        return $this->transport->request('GET', $this->basePath.'records/'.rawurlencode((string) $recordId).'/');
    }

    public function transactions(array $query = []): array
    {
        $response = $this->transport->request('GET', $this->basePath.'transactions/', query: $query);

        return $response['items'] ?? [];
    }

    public function transaction(int|string $recordId): array
    {
        return $this->transport->request('GET', $this->basePath.'transactions/'.rawurlencode((string) $recordId).'/');
    }
}
