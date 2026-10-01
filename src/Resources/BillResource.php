<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\Bill;
use FoundryCo\DualEntry\Resources\Data\BillLineItem;
use FoundryCo\DualEntry\Support\Paginator;

final class BillResource extends AbstractResource
{
    protected string $basePath = 'bills/';

    /**
     * @return array<int, Bill>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): Bill => Bill::fromWire($row),
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

    public function find(int|string $id): Bill
    {
        return Bill::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via Bill::make(...).
     */
    public function create(Bill $record): Bill
    {
        return Bill::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, Bill $record): Bill
    {
        return Bill::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * Partial update (PATCH) — a plain array of wire-format (snake_case)
     * fields to change; anything you don't include stays as it is.
     */
    public function update(int|string $id, array $fields): Bill
    {
        return Bill::fromWire($this->performUpdate($id, $fields));
    }

    /**
     * @return array<int, BillLineItem>
     */
    public function lines(int|string $id, array $query = []): array
    {
        return array_map(
            static fn (array $row): BillLineItem => BillLineItem::fromWire($row),
            $this->performLines($id, $query),
        );
    }

    /**
     * @param  array<int, string>  $filePaths  Local filesystem paths of the files to upload.
     */
    public function uploadAttachments(int|string $id, array $filePaths): Bill
    {
        return Bill::fromWire($this->performUploadAttachments($id, $filePaths));
    }
}
