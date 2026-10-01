<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\Account;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Supports list, create, and find (no update or delete).
 */
final class AccountResource extends AbstractResource
{
    protected string $basePath = 'accounts/';

    /**
     * @return array<int, Account>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): Account => Account::fromWire($row),
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

    public function find(int|string $id): Account
    {
        return Account::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via Account::make(...).
     */
    public function create(Account $record): Account
    {
        return Account::fromWire($this->performCreate($record->toWire()));
    }
}
