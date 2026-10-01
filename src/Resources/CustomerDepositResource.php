<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\CustomerDeposit;
use FoundryCo\DualEntry\Resources\Data\CustomerDepositLineItem;
use FoundryCo\DualEntry\Support\Paginator;

final class CustomerDepositResource extends AbstractResource
{
    protected string $basePath = 'customer-deposits/';

    /**
     * @return array<int, CustomerDeposit>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): CustomerDeposit => CustomerDeposit::fromWire($row),
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

    public function find(int|string $id): CustomerDeposit
    {
        return CustomerDeposit::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via CustomerDeposit::make(...).
     */
    public function create(CustomerDeposit $record): CustomerDeposit
    {
        return CustomerDeposit::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, CustomerDeposit $record): CustomerDeposit
    {
        return CustomerDeposit::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * @return array<int, CustomerDepositLineItem>
     */
    public function lines(int|string $id, array $query = []): array
    {
        return array_map(
            static fn (array $row): CustomerDepositLineItem => CustomerDepositLineItem::fromWire($row),
            $this->performLines($id, $query),
        );
    }

    /**
     * @param  array<int, string>  $filePaths  Local filesystem paths of the files to upload.
     */
    public function uploadAttachments(int|string $id, array $filePaths): CustomerDeposit
    {
        return CustomerDeposit::fromWire($this->performUploadAttachments($id, $filePaths));
    }
}
