<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\FixedAssetClass;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Read-only. Supports list and find.
 */
final class FixedAssetClassResource extends AbstractResource
{
    protected string $basePath = 'fixed-asset-classes/';

    /**
     * @return array<int, FixedAssetClass>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): FixedAssetClass => FixedAssetClass::fromWire($row),
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

    public function find(int|string $id): FixedAssetClass
    {
        return FixedAssetClass::fromWire($this->performFind($id));
    }
}
