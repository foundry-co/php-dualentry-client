<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\RecurringJournalEntry;
use FoundryCo\DualEntry\Support\Paginator;

final class RecurringJournalEntryResource extends AbstractResource
{
    protected string $basePath = 'recurring/journal-entries/';

    /**
     * @return array<int, RecurringJournalEntry>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): RecurringJournalEntry => RecurringJournalEntry::fromWire($row),
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

    public function find(int|string $id): RecurringJournalEntry
    {
        return RecurringJournalEntry::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via RecurringJournalEntry::make(...).
     */
    public function create(RecurringJournalEntry $record): RecurringJournalEntry
    {
        return RecurringJournalEntry::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, RecurringJournalEntry $record): RecurringJournalEntry
    {
        return RecurringJournalEntry::fromWire($this->performReplace($id, $record->toWire()));
    }

    public function delete(int|string $id): void
    {
        $this->performDelete($id);
    }
}
