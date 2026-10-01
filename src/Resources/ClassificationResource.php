<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\Classification;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Dimensional classifications, e.g. departments or locations.
 */
final class ClassificationResource extends AbstractResource
{
    protected string $basePath = 'classifications/';

    /**
     * @return array<int, Classification>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): Classification => Classification::fromWire($row),
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

    public function find(int|string $id): Classification
    {
        return Classification::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via Classification::make(...).
     */
    public function create(Classification $record): Classification
    {
        return Classification::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, Classification $record): Classification
    {
        return Classification::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * Partial update (PATCH) — a plain array of wire-format (snake_case)
     * fields to change; anything you don't include stays as it is.
     */
    public function update(int|string $id, array $fields): Classification
    {
        return Classification::fromWire($this->performUpdate($id, $fields));
    }

    public function delete(int|string $id): void
    {
        $this->performDelete($id);
    }
}
