<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\PurchaseOrder;
use FoundryCo\DualEntry\Resources\Data\PurchaseOrderLineItem;
use FoundryCo\DualEntry\Support\Paginator;

final class PurchaseOrderResource extends AbstractResource
{
    protected string $basePath = 'purchase-orders/';

    /**
     * @return array<int, PurchaseOrder>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): PurchaseOrder => PurchaseOrder::fromWire($row),
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

    public function find(int|string $id): PurchaseOrder
    {
        return PurchaseOrder::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via PurchaseOrder::make(...).
     */
    public function create(PurchaseOrder $record): PurchaseOrder
    {
        return PurchaseOrder::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, PurchaseOrder $record): PurchaseOrder
    {
        return PurchaseOrder::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * @return array<int, PurchaseOrderLineItem>
     */
    public function lines(int|string $id, array $query = []): array
    {
        return array_map(
            static fn (array $row): PurchaseOrderLineItem => PurchaseOrderLineItem::fromWire($row),
            $this->performLines($id, $query),
        );
    }

    /**
     * @param  array<int, string>  $filePaths  Local filesystem paths of the files to upload.
     */
    public function uploadAttachments(int|string $id, array $filePaths): PurchaseOrder
    {
        return PurchaseOrder::fromWire($this->performUploadAttachments($id, $filePaths));
    }
}
