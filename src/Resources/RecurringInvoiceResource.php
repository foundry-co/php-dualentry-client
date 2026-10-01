<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\RecurringInvoice;
use FoundryCo\DualEntry\Support\Paginator;

final class RecurringInvoiceResource extends AbstractResource
{
    protected string $basePath = 'recurring/invoices/';

    /**
     * @return array<int, RecurringInvoice>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): RecurringInvoice => RecurringInvoice::fromWire($row),
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

    public function find(int|string $id): RecurringInvoice
    {
        return RecurringInvoice::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via RecurringInvoice::make(...).
     */
    public function create(RecurringInvoice $record): RecurringInvoice
    {
        return RecurringInvoice::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, RecurringInvoice $record): RecurringInvoice
    {
        return RecurringInvoice::fromWire($this->performReplace($id, $record->toWire()));
    }

    public function delete(int|string $id): void
    {
        $this->performDelete($id);
    }
}
