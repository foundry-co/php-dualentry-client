<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\CustomerRefund;
use FoundryCo\DualEntry\Resources\Data\CustomerRefundLineItem;
use FoundryCo\DualEntry\Support\Paginator;

final class CustomerRefundResource extends AbstractResource
{
    protected string $basePath = 'customer-refunds/';

    /**
     * @return array<int, CustomerRefund>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): CustomerRefund => CustomerRefund::fromWire($row),
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

    public function find(int|string $id): CustomerRefund
    {
        return CustomerRefund::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via CustomerRefund::make(...).
     */
    public function create(CustomerRefund $record): CustomerRefund
    {
        return CustomerRefund::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, CustomerRefund $record): CustomerRefund
    {
        return CustomerRefund::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * @return array<int, CustomerRefundLineItem>
     */
    public function lines(int|string $id, array $query = []): array
    {
        return array_map(
            static fn (array $row): CustomerRefundLineItem => CustomerRefundLineItem::fromWire($row),
            $this->performLines($id, $query),
        );
    }

    /**
     * @param  array<int, string>  $filePaths  Local filesystem paths of the files to upload.
     */
    public function uploadAttachments(int|string $id, array $filePaths): CustomerRefund
    {
        return CustomerRefund::fromWire($this->performUploadAttachments($id, $filePaths));
    }
}
