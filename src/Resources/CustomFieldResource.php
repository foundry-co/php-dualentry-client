<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\CustomField;
use FoundryCo\DualEntry\Support\Paginator;

final class CustomFieldResource extends AbstractResource
{
    protected string $basePath = 'custom-fields/';

    /**
     * @return array<int, CustomField>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): CustomField => CustomField::fromWire($row),
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

    public function find(int|string $id): CustomField
    {
        return CustomField::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via CustomField::make(...).
     */
    public function create(CustomField $record): CustomField
    {
        return CustomField::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, CustomField $record): CustomField
    {
        return CustomField::fromWire($this->performReplace($id, $record->toWire()));
    }

    public function delete(int|string $id): void
    {
        $this->performDelete($id);
    }
}
