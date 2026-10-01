<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\CashSale;
use FoundryCo\DualEntry\Resources\Data\CashSaleLineItem;
use FoundryCo\DualEntry\Support\Paginator;

final class CashSaleResource extends AbstractResource
{
    protected string $basePath = 'cash-sales/';

    /**
     * @return array<int, CashSale>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): CashSale => CashSale::fromWire($row),
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

    public function find(int|string $id): CashSale
    {
        return CashSale::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via CashSale::make(...).
     */
    public function create(CashSale $record): CashSale
    {
        return CashSale::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, CashSale $record): CashSale
    {
        return CashSale::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * @return array<int, CashSaleLineItem>
     */
    public function lines(int|string $id, array $query = []): array
    {
        return array_map(
            static fn (array $row): CashSaleLineItem => CashSaleLineItem::fromWire($row),
            $this->performLines($id, $query),
        );
    }

    /**
     * @param  array<int, string>  $filePaths  Local filesystem paths of the files to upload.
     */
    public function uploadAttachments(int|string $id, array $filePaths): CashSale
    {
        return CashSale::fromWire($this->performUploadAttachments($id, $filePaths));
    }
}
