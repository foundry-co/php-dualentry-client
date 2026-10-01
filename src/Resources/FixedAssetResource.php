<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\FixedAsset;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Fixed assets.
 */
final class FixedAssetResource extends AbstractResource
{
    protected string $basePath = 'fixed-assets/';

    /**
     * @return array<int, FixedAsset>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): FixedAsset => FixedAsset::fromWire($row),
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

    public function find(int|string $id): FixedAsset
    {
        return FixedAsset::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via FixedAsset::make(...).
     */
    public function create(FixedAsset $record): FixedAsset
    {
        return FixedAsset::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, FixedAsset $record): FixedAsset
    {
        return FixedAsset::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * Partial update (PATCH) — a plain array of wire-format (snake_case)
     * fields to change; anything you don't include stays as it is.
     */
    public function update(int|string $id, array $fields): FixedAsset
    {
        return FixedAsset::fromWire($this->performUpdate($id, $fields));
    }

    public function delete(int|string $id): void
    {
        $this->performDelete($id);
    }

    /**
     * The depreciation schedule for an asset under a given depreciation book.
     */
    public function schedule(int|string $fixedAssetNumber, int|string $depreciationBookId): array
    {
        return $this->transport->request(
            'GET',
            $this->itemPath($fixedAssetNumber).'schedules/'.rawurlencode((string) $depreciationBookId).'/schedule/',
        );
    }
}
