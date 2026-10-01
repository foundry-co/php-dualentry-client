<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\CustomerPrepayment;
use FoundryCo\DualEntry\Support\Paginator;

final class CustomerPrepaymentResource extends AbstractResource
{
    protected string $basePath = 'customer-prepayments/';

    /**
     * @return array<int, CustomerPrepayment>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): CustomerPrepayment => CustomerPrepayment::fromWire($row),
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

    public function find(int|string $id): CustomerPrepayment
    {
        return CustomerPrepayment::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via CustomerPrepayment::make(...).
     */
    public function create(CustomerPrepayment $record): CustomerPrepayment
    {
        return CustomerPrepayment::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, CustomerPrepayment $record): CustomerPrepayment
    {
        return CustomerPrepayment::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * Partial update (PATCH) — a plain array of wire-format (snake_case)
     * fields to change; anything you don't include stays as it is.
     */
    public function update(int|string $id, array $fields): CustomerPrepayment
    {
        return CustomerPrepayment::fromWire($this->performUpdate($id, $fields));
    }

    /**
     * @param  array<int, string>  $filePaths  Local filesystem paths of the files to upload.
     */
    public function uploadAttachments(int|string $id, array $filePaths): CustomerPrepayment
    {
        return CustomerPrepayment::fromWire($this->performUploadAttachments($id, $filePaths));
    }
}
