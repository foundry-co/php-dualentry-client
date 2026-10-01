<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\StatisticalJournal;
use FoundryCo\DualEntry\Resources\Data\StatisticalJournalLineItem;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Non-financial journal entries.
 */
final class StatisticalJournalResource extends AbstractResource
{
    protected string $basePath = 'statistical-journals/';

    /**
     * @return array<int, StatisticalJournal>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): StatisticalJournal => StatisticalJournal::fromWire($row),
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

    public function find(int|string $id): StatisticalJournal
    {
        return StatisticalJournal::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via StatisticalJournal::make(...).
     */
    public function create(StatisticalJournal $record): StatisticalJournal
    {
        return StatisticalJournal::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, StatisticalJournal $record): StatisticalJournal
    {
        return StatisticalJournal::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * @return array<int, StatisticalJournalLineItem>
     */
    public function lines(int|string $id, array $query = []): array
    {
        return array_map(
            static fn (array $row): StatisticalJournalLineItem => StatisticalJournalLineItem::fromWire($row),
            $this->performLines($id, $query),
        );
    }

    /**
     * @param  array<int, string>  $filePaths  Local filesystem paths of the files to upload.
     */
    public function uploadAttachments(int|string $id, array $filePaths): StatisticalJournal
    {
        return StatisticalJournal::fromWire($this->performUploadAttachments($id, $filePaths));
    }
}
