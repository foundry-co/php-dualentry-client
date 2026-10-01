<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\VendorPrepayment;
use FoundryCo\DualEntry\Support\Paginator;

final class VendorPrepaymentResource extends AbstractResource
{
    protected string $basePath = 'vendor-prepayments/';

    /**
     * @return array<int, VendorPrepayment>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): VendorPrepayment => VendorPrepayment::fromWire($row),
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

    public function find(int|string $id): VendorPrepayment
    {
        return VendorPrepayment::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via VendorPrepayment::make(...).
     */
    public function create(VendorPrepayment $record): VendorPrepayment
    {
        return VendorPrepayment::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, VendorPrepayment $record): VendorPrepayment
    {
        return VendorPrepayment::fromWire($this->performReplace($id, $record->toWire()));
    }
}
