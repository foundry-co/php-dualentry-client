<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\VendorPayment;
use FoundryCo\DualEntry\Resources\Data\VendorPaymentLineItem;
use FoundryCo\DualEntry\Support\Paginator;

final class VendorPaymentResource extends AbstractResource
{
    protected string $basePath = 'vendor-payments/';

    /**
     * @return array<int, VendorPayment>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): VendorPayment => VendorPayment::fromWire($row),
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

    public function find(int|string $id): VendorPayment
    {
        return VendorPayment::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via VendorPayment::make(...).
     */
    public function create(VendorPayment $record): VendorPayment
    {
        return VendorPayment::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, VendorPayment $record): VendorPayment
    {
        return VendorPayment::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * Partial update (PATCH) — a plain array of wire-format (snake_case)
     * fields to change; anything you don't include stays as it is.
     */
    public function update(int|string $id, array $fields): VendorPayment
    {
        return VendorPayment::fromWire($this->performUpdate($id, $fields));
    }

    /**
     * @return array<int, VendorPaymentLineItem>
     */
    public function lines(int|string $id, array $query = []): array
    {
        return array_map(
            static fn (array $row): VendorPaymentLineItem => VendorPaymentLineItem::fromWire($row),
            $this->performLines($id, $query),
        );
    }

    /**
     * @param  array<int, string>  $filePaths  Local filesystem paths of the files to upload.
     */
    public function uploadAttachments(int|string $id, array $filePaths): VendorPayment
    {
        return VendorPayment::fromWire($this->performUploadAttachments($id, $filePaths));
    }
}
