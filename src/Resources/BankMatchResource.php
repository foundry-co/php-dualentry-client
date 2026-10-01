<?php

namespace FoundryCo\DualEntry\Resources;

/**
 * Bank reconciliation: suggestions, matches, and bank transactions.
 *
 * This resource doesn't follow the usual list/create/get/update/delete
 * shape, so it ignores the inherited CRUD methods and exposes its own, more
 * specific ones instead.
 */
final class BankMatchResource extends AbstractResource
{
    protected string $basePath = 'bank-match/';

    /**
     * Generate fresh match suggestions for unreconciled bank transactions.
     */
    public function populateSuggestions(array $payload = []): array
    {
        return $this->transport->request('POST', $this->basePath.'populate/', json: $payload, idempotent: true);
    }

    public function suggestions(array $query = []): array
    {
        $response = $this->transport->request('GET', $this->basePath.'suggestions/', query: $query);

        return $response['items'] ?? [];
    }

    public function suggestion(int|string $suggestionId): array
    {
        return $this->transport->request('GET', $this->basePath.'suggestions/'.rawurlencode((string) $suggestionId).'/');
    }

    /**
     * Counts of bank transactions by match status.
     */
    public function statusCounts(array $query = []): array
    {
        return $this->transport->request('GET', $this->basePath.'status-counts/', query: $query);
    }

    public function bankTransactions(array $query = []): array
    {
        $response = $this->transport->request('GET', $this->basePath.'bank-transactions/', query: $query);

        return $response['items'] ?? [];
    }

    public function bankTransaction(int|string $financialTransactionId): array
    {
        return $this->transport->request('GET', $this->basePath.'bank-transactions/'.rawurlencode((string) $financialTransactionId).'/');
    }

    /**
     * Confirm a match between a bank transaction and a DualEntry record.
     */
    public function match(array $payload): array
    {
        return $this->transport->request('POST', $this->basePath.'matches/', json: $payload, idempotent: true);
    }

    /**
     * Undo a previously confirmed match.
     */
    public function unmatch(array $payload): array
    {
        return $this->transport->request('POST', $this->basePath.'unmatches/', json: $payload, idempotent: true);
    }
}
