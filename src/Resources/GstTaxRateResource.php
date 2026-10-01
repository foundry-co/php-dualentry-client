<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\GstTaxRate;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Read-only. Supports list and find.
 */
final class GstTaxRateResource extends AbstractResource
{
    protected string $basePath = 'gst-tax-rates/';

    /**
     * @return array<int, GstTaxRate>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): GstTaxRate => GstTaxRate::fromWire($row),
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

    public function find(int|string $id): GstTaxRate
    {
        return GstTaxRate::fromWire($this->performFind($id));
    }
}
