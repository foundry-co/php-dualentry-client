<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\DepreciationBook;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Read-only. Supports list and find.
 */
final class DepreciationBookResource extends AbstractResource
{
    protected string $basePath = 'depreciation-books/';

    /**
     * @return array<int, DepreciationBook>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): DepreciationBook => DepreciationBook::fromWire($row),
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

    public function find(int|string $id): DepreciationBook
    {
        return DepreciationBook::fromWire($this->performFind($id));
    }
}
