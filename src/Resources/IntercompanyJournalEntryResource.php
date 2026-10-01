<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\IntercompanyJournalEntry;
use FoundryCo\DualEntry\Support\Paginator;

final class IntercompanyJournalEntryResource extends AbstractResource
{
    protected string $basePath = 'intercompany-journal-entries/';

    /**
     * @return array<int, IntercompanyJournalEntry>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): IntercompanyJournalEntry => IntercompanyJournalEntry::fromWire($row),
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

    public function find(int|string $id): IntercompanyJournalEntry
    {
        return IntercompanyJournalEntry::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via IntercompanyJournalEntry::make(...).
     */
    public function create(IntercompanyJournalEntry $record): IntercompanyJournalEntry
    {
        return IntercompanyJournalEntry::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, IntercompanyJournalEntry $record): IntercompanyJournalEntry
    {
        return IntercompanyJournalEntry::fromWire($this->performReplace($id, $record->toWire()));
    }
}
