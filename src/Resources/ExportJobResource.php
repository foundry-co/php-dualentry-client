<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\ExportJob;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Asynchronous bulk data export jobs. Create a job, then poll {@see find()}
 * until it completes.
 */
final class ExportJobResource extends AbstractResource
{
    protected string $basePath = 'export-jobs/';

    /**
     * @return array<int, ExportJob>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): ExportJob => ExportJob::fromWire($row),
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

    public function find(int|string $id): ExportJob
    {
        return ExportJob::fromWire($this->performFind($id));
    }
}
