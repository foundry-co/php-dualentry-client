<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\Contract;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Customer contracts, with nested change orders and usage records.
 */
final class ContractResource extends AbstractResource
{
    protected string $basePath = 'contracts/';

    /**
     * @return array<int, Contract>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): Contract => Contract::fromWire($row),
            $this->performList($filters),
        );
    }

    /**
     * Lazily walk every page of the list endpoint and yield each record.
     */
    public function paginate(array $filters = []): Paginator
    {
        return new Paginator(fn (array $page) => $this->list($page), $filters);
    }

    public function find(int|string $id): Contract
    {
        return Contract::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via Contract::make(...).
     */
    public function create(Contract $record): Contract
    {
        return Contract::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, Contract $record): Contract
    {
        return Contract::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * Partial update (PATCH) — a plain array of wire-format (snake_case)
     * fields to change; anything you don't include stays as it is.
     */
    public function update(int|string $id, array $fields): Contract
    {
        return Contract::fromWire($this->performUpdate($id, $fields));
    }

    public function listChangeOrders(int|string $contractId, array $query = []): array
    {
        $response = $this->transport->request('GET', $this->changeOrdersPath($contractId), query: $query);

        return $response['items'] ?? [];
    }

    public function findChangeOrder(int|string $contractId, int|string $changeOrderId): array
    {
        return $this->transport->request('GET', $this->changeOrdersPath($contractId).rawurlencode((string) $changeOrderId).'/');
    }

    public function createChangeOrder(int|string $contractId, array $payload): array
    {
        return $this->transport->request('POST', $this->changeOrdersPath($contractId), json: $payload, idempotent: true);
    }

    public function updateChangeOrder(int|string $contractId, int|string $changeOrderId, array $payload): array
    {
        return $this->transport->request(
            'PUT',
            $this->changeOrdersPath($contractId).rawurlencode((string) $changeOrderId).'/',
            json: $payload,
            idempotent: true,
        );
    }

    public function deleteChangeOrder(int|string $contractId, int|string $changeOrderId): void
    {
        $this->transport->request(
            'DELETE',
            $this->changeOrdersPath($contractId).rawurlencode((string) $changeOrderId).'/',
            idempotent: true,
        );
    }

    public function usage(int|string $contractId, array $query = []): array
    {
        return $this->transport->request('GET', $this->usagePath($contractId), query: $query);
    }

    /**
     * Create and/or update multiple usage records in a single call.
     */
    public function bulkUpsertUsage(int|string $contractId, array $payload): array
    {
        return $this->transport->request('POST', $this->usagePath($contractId).'bulk-upsert/', json: $payload, idempotent: true);
    }

    private function changeOrdersPath(int|string $contractId): string
    {
        return $this->basePath.rawurlencode((string) $contractId).'/change-orders/';
    }

    private function usagePath(int|string $contractId): string
    {
        return $this->basePath.rawurlencode((string) $contractId).'/usage/';
    }
}
