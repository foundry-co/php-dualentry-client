<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\VatRate;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Read-only. Supports list and find.
 */
final class VatRateResource extends AbstractResource
{
    protected string $basePath = 'vat-rates/';

    /**
     * @return array<int, VatRate>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): VatRate => VatRate::fromWire($row),
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

    public function find(int|string $id): VatRate
    {
        return VatRate::fromWire($this->performFind($id));
    }
}
