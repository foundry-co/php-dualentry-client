<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\DirectExpense;
use FoundryCo\DualEntry\Resources\Data\DirectExpenseLineItem;
use FoundryCo\DualEntry\Support\Paginator;

final class DirectExpenseResource extends AbstractResource
{
    protected string $basePath = 'direct-expenses/';

    /**
     * @return array<int, DirectExpense>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): DirectExpense => DirectExpense::fromWire($row),
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

    public function find(int|string $id): DirectExpense
    {
        return DirectExpense::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via DirectExpense::make(...).
     */
    public function create(DirectExpense $record): DirectExpense
    {
        return DirectExpense::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, DirectExpense $record): DirectExpense
    {
        return DirectExpense::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * @return array<int, DirectExpenseLineItem>
     */
    public function lines(int|string $id, array $query = []): array
    {
        return array_map(
            static fn (array $row): DirectExpenseLineItem => DirectExpenseLineItem::fromWire($row),
            $this->performLines($id, $query),
        );
    }

    /**
     * @param  array<int, string>  $filePaths  Local filesystem paths of the files to upload.
     */
    public function uploadAttachments(int|string $id, array $filePaths): DirectExpense
    {
        return DirectExpense::fromWire($this->performUploadAttachments($id, $filePaths));
    }
}
