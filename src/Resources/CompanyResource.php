<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\Company;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Read-only. Supports list and find.
 */
final class CompanyResource extends AbstractResource
{
    protected string $basePath = 'companies/';

    /**
     * @return array<int, Company>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): Company => Company::fromWire($row),
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

    public function find(int|string $id): Company
    {
        return Company::fromWire($this->performFind($id));
    }
}
