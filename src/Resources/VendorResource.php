<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\Vendor;
use FoundryCo\DualEntry\Support\Paginator;

final class VendorResource extends AbstractResource
{
    protected string $basePath = 'vendors/';

    /**
     * @return array<int, Vendor>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): Vendor => Vendor::fromWire($row),
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

    public function find(int|string $id): Vendor
    {
        return Vendor::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via Vendor::make(...).
     */
    public function create(Vendor $record): Vendor
    {
        return Vendor::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, Vendor $record): Vendor
    {
        return Vendor::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * Partial update (PATCH) — a plain array of wire-format (snake_case)
     * fields to change; anything you don't include stays as it is.
     */
    public function update(int|string $id, array $fields): Vendor
    {
        return Vendor::fromWire($this->performUpdate($id, $fields));
    }

    public function delete(int|string $id): void
    {
        $this->performDelete($id);
    }
}
