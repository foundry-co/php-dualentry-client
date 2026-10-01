<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\JournalEntry;
use FoundryCo\DualEntry\Resources\Data\JournalEntryLineItem;
use FoundryCo\DualEntry\Support\Paginator;

final class JournalEntryResource extends AbstractResource
{
    protected string $basePath = 'journal-entries/';

    /**
     * @return array<int, JournalEntry>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): JournalEntry => JournalEntry::fromWire($row),
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

    public function find(int|string $id): JournalEntry
    {
        return JournalEntry::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via JournalEntry::make(...).
     */
    public function create(JournalEntry $record): JournalEntry
    {
        return JournalEntry::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, JournalEntry $record): JournalEntry
    {
        return JournalEntry::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * @return array<int, JournalEntryLineItem>
     */
    public function lines(int|string $id, array $query = []): array
    {
        return array_map(
            static fn (array $row): JournalEntryLineItem => JournalEntryLineItem::fromWire($row),
            $this->performLines($id, $query),
        );
    }

    /**
     * @param  array<int, string>  $filePaths  Local filesystem paths of the files to upload.
     */
    public function uploadAttachments(int|string $id, array $filePaths): JournalEntry
    {
        return JournalEntry::fromWire($this->performUploadAttachments($id, $filePaths));
    }
}
