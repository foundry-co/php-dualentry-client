<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\SalesOrder;
use FoundryCo\DualEntry\Resources\Data\SalesOrderLineItem;
use FoundryCo\DualEntry\Support\Paginator;

final class SalesOrderResource extends AbstractResource
{
    protected string $basePath = 'sales-orders/';

    /**
     * @return array<int, SalesOrder>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): SalesOrder => SalesOrder::fromWire($row),
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

    public function find(int|string $id): SalesOrder
    {
        return SalesOrder::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via SalesOrder::make(...).
     */
    public function create(SalesOrder $record): SalesOrder
    {
        return SalesOrder::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, SalesOrder $record): SalesOrder
    {
        return SalesOrder::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * @return array<int, SalesOrderLineItem>
     */
    public function lines(int|string $id, array $query = []): array
    {
        return array_map(
            static fn (array $row): SalesOrderLineItem => SalesOrderLineItem::fromWire($row),
            $this->performLines($id, $query),
        );
    }

    /**
     * @param  array<int, string>  $filePaths  Local filesystem paths of the files to upload.
     */
    public function uploadAttachments(int|string $id, array $filePaths): SalesOrder
    {
        return SalesOrder::fromWire($this->performUploadAttachments($id, $filePaths));
    }
}
