<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\Item;
use FoundryCo\DualEntry\Support\Paginator;

final class ItemResource extends AbstractResource
{
    protected string $basePath = 'items/';

    /**
     * @return array<int, Item>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): Item => Item::fromWire($row),
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

    public function find(int|string $id): Item
    {
        return Item::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via Item::make(...).
     */
    public function create(Item $record): Item
    {
        return Item::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, Item $record): Item
    {
        return Item::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * Partial update (PATCH) — a plain array of wire-format (snake_case)
     * fields to change; anything you don't include stays as it is.
     */
    public function update(int|string $id, array $fields): Item
    {
        return Item::fromWire($this->performUpdate($id, $fields));
    }

    public function delete(int|string $id): void
    {
        $this->performDelete($id);
    }
}
