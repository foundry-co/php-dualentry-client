<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\VendorPrepaymentApplication;
use FoundryCo\DualEntry\Resources\Data\VendorPrepaymentApplicationLineItem;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Applications of vendor prepayments against bills.
 */
final class VendorPrepaymentApplicationResource extends AbstractResource
{
    protected string $basePath = 'vendor-prepayment-applications/';

    /**
     * @return array<int, VendorPrepaymentApplication>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): VendorPrepaymentApplication => VendorPrepaymentApplication::fromWire($row),
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

    public function find(int|string $id): VendorPrepaymentApplication
    {
        return VendorPrepaymentApplication::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via VendorPrepaymentApplication::make(...).
     */
    public function create(VendorPrepaymentApplication $record): VendorPrepaymentApplication
    {
        return VendorPrepaymentApplication::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, VendorPrepaymentApplication $record): VendorPrepaymentApplication
    {
        return VendorPrepaymentApplication::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * @return array<int, VendorPrepaymentApplicationLineItem>
     */
    public function lines(int|string $id, array $query = []): array
    {
        return array_map(
            static fn (array $row): VendorPrepaymentApplicationLineItem => VendorPrepaymentApplicationLineItem::fromWire($row),
            $this->performLines($id, $query),
        );
    }
}
