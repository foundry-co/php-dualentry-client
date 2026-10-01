<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\CustomerPrepaymentApplication;
use FoundryCo\DualEntry\Resources\Data\CustomerPrepaymentApplicationLineItem;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Applications of customer prepayments against invoices.
 */
final class CustomerPrepaymentApplicationResource extends AbstractResource
{
    protected string $basePath = 'customer-prepayment-applications/';

    /**
     * @return array<int, CustomerPrepaymentApplication>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): CustomerPrepaymentApplication => CustomerPrepaymentApplication::fromWire($row),
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

    public function find(int|string $id): CustomerPrepaymentApplication
    {
        return CustomerPrepaymentApplication::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via CustomerPrepaymentApplication::make(...).
     */
    public function create(CustomerPrepaymentApplication $record): CustomerPrepaymentApplication
    {
        return CustomerPrepaymentApplication::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, CustomerPrepaymentApplication $record): CustomerPrepaymentApplication
    {
        return CustomerPrepaymentApplication::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * Partial update (PATCH) — a plain array of wire-format (snake_case)
     * fields to change; anything you don't include stays as it is.
     */
    public function update(int|string $id, array $fields): CustomerPrepaymentApplication
    {
        return CustomerPrepaymentApplication::fromWire($this->performUpdate($id, $fields));
    }

    /**
     * @return array<int, CustomerPrepaymentApplicationLineItem>
     */
    public function lines(int|string $id, array $query = []): array
    {
        return array_map(
            static fn (array $row): CustomerPrepaymentApplicationLineItem => CustomerPrepaymentApplicationLineItem::fromWire($row),
            $this->performLines($id, $query),
        );
    }

    /**
     * @param  array<int, string>  $filePaths  Local filesystem paths of the files to upload.
     */
    public function uploadAttachments(int|string $id, array $filePaths): CustomerPrepaymentApplication
    {
        return CustomerPrepaymentApplication::fromWire($this->performUploadAttachments($id, $filePaths));
    }
}
