<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\VendorRefund;
use FoundryCo\DualEntry\Resources\Data\VendorRefundLineItem;
use FoundryCo\DualEntry\Support\Paginator;

final class VendorRefundResource extends AbstractResource
{
    protected string $basePath = 'vendor-refunds/';

    /**
     * @return array<int, VendorRefund>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): VendorRefund => VendorRefund::fromWire($row),
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

    public function find(int|string $id): VendorRefund
    {
        return VendorRefund::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via VendorRefund::make(...).
     */
    public function create(VendorRefund $record): VendorRefund
    {
        return VendorRefund::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, VendorRefund $record): VendorRefund
    {
        return VendorRefund::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * @return array<int, VendorRefundLineItem>
     */
    public function lines(int|string $id, array $query = []): array
    {
        return array_map(
            static fn (array $row): VendorRefundLineItem => VendorRefundLineItem::fromWire($row),
            $this->performLines($id, $query),
        );
    }

    /**
     * @param  array<int, string>  $filePaths  Local filesystem paths of the files to upload.
     */
    public function uploadAttachments(int|string $id, array $filePaths): VendorRefund
    {
        return VendorRefund::fromWire($this->performUploadAttachments($id, $filePaths));
    }
}
