<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\Budget;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Read-only. Supports list and find.
 */
final class BudgetResource extends AbstractResource
{
    protected string $basePath = 'budgets/';

    /**
     * @return array<int, Budget>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): Budget => Budget::fromWire($row),
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

    public function find(int|string $id): Budget
    {
        return Budget::fromWire($this->performFind($id));
    }
}
