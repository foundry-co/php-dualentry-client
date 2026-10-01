<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\BankConnection;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Bank feed connections (inbound bank data). See
 * https://docs.dualentry.com/developers/guides/api/building-blocks/bank-connections-inbound
 */
final class BankConnectionResource extends AbstractResource
{
    protected string $basePath = 'bank-connections/';

    /**
     * @return array<int, BankConnection>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): BankConnection => BankConnection::fromWire($row),
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

    public function find(int|string $id): BankConnection
    {
        return BankConnection::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via BankConnection::make(...).
     */
    public function create(BankConnection $record): BankConnection
    {
        return BankConnection::fromWire($this->performCreate($record->toWire()));
    }

    public function delete(int|string $id): void
    {
        $this->performDelete($id);
    }

    public function listAccounts(int|string $connectionId, array $query = []): array
    {
        return $this->transport->request('GET', $this->itemPath($connectionId).'accounts/', query: $query);
    }

    public function registerAccount(int|string $connectionId, array $payload): array
    {
        return $this->transport->request('POST', $this->itemPath($connectionId).'accounts/', json: $payload, idempotent: true);
    }

    /**
     * Push transactions for a financial account into the inbound bank feed.
     */
    public function ingestTransactions(int|string $financialAccountId, array $payload): array
    {
        return $this->transport->request(
            'POST',
            $this->basePath.'accounts/'.rawurlencode((string) $financialAccountId).'/transactions/',
            json: $payload,
            idempotent: true,
        );
    }
}
