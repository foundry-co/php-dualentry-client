<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\BankTransfer;
use FoundryCo\DualEntry\Support\Paginator;

final class BankTransferResource extends AbstractResource
{
    protected string $basePath = 'bank-transfers/';

    /**
     * @return array<int, BankTransfer>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): BankTransfer => BankTransfer::fromWire($row),
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

    public function find(int|string $id): BankTransfer
    {
        return BankTransfer::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via BankTransfer::make(...).
     */
    public function create(BankTransfer $record): BankTransfer
    {
        return BankTransfer::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, BankTransfer $record): BankTransfer
    {
        return BankTransfer::fromWire($this->performReplace($id, $record->toWire()));
    }
}
