<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\VendorCredit;
use FoundryCo\DualEntry\Resources\Data\VendorCreditLineItem;
use FoundryCo\DualEntry\Support\Paginator;

final class VendorCreditResource extends AbstractResource
{
    protected string $basePath = 'vendor-credits/';

    /**
     * @return array<int, VendorCredit>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): VendorCredit => VendorCredit::fromWire($row),
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

    public function find(int|string $id): VendorCredit
    {
        return VendorCredit::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via VendorCredit::make(...).
     */
    public function create(VendorCredit $record): VendorCredit
    {
        return VendorCredit::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, VendorCredit $record): VendorCredit
    {
        return VendorCredit::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * @return array<int, VendorCreditLineItem>
     */
    public function lines(int|string $id, array $query = []): array
    {
        return array_map(
            static fn (array $row): VendorCreditLineItem => VendorCreditLineItem::fromWire($row),
            $this->performLines($id, $query),
        );
    }
}
