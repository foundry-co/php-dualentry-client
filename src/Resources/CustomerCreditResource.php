<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\CustomerCredit;
use FoundryCo\DualEntry\Resources\Data\CustomerCreditLineItem;
use FoundryCo\DualEntry\Support\Paginator;

final class CustomerCreditResource extends AbstractResource
{
    protected string $basePath = 'customer-credits/';

    /**
     * @return array<int, CustomerCredit>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): CustomerCredit => CustomerCredit::fromWire($row),
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

    public function find(int|string $id): CustomerCredit
    {
        return CustomerCredit::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via CustomerCredit::make(...).
     */
    public function create(CustomerCredit $record): CustomerCredit
    {
        return CustomerCredit::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, CustomerCredit $record): CustomerCredit
    {
        return CustomerCredit::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * Partial update (PATCH) — a plain array of wire-format (snake_case)
     * fields to change; anything you don't include stays as it is.
     */
    public function update(int|string $id, array $fields): CustomerCredit
    {
        return CustomerCredit::fromWire($this->performUpdate($id, $fields));
    }

    /**
     * @return array<int, CustomerCreditLineItem>
     */
    public function lines(int|string $id, array $query = []): array
    {
        return array_map(
            static fn (array $row): CustomerCreditLineItem => CustomerCreditLineItem::fromWire($row),
            $this->performLines($id, $query),
        );
    }
}
