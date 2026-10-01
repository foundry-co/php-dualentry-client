<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\PaperCheck;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Paper checks. There is no plain `create`/`update` — checks are produced
 * via {@see printNow()}, {@see printLater()}, or {@see printBatch()}.
 */
final class PaperCheckResource extends AbstractResource
{
    protected string $basePath = 'paper-checks/';

    /**
     * @return array<int, PaperCheck>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): PaperCheck => PaperCheck::fromWire($row),
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

    public function find(int|string $id): PaperCheck
    {
        return PaperCheck::fromWire($this->performFind($id));
    }

    public function delete(int|string $id): void
    {
        $this->performDelete($id);
    }

    /**
     * Print one or more checks immediately.
     */
    public function printNow(array $payload): array
    {
        return $this->transport->request('POST', $this->basePath.'print-now/', json: $payload, idempotent: true);
    }

    /**
     * Queue one or more checks to be printed in a later batch run.
     */
    public function printLater(array $payload): array
    {
        return $this->transport->request('POST', $this->basePath.'print-later/', json: $payload, idempotent: true);
    }

    /**
     * Mark a batch of previously-queued checks as printed.
     */
    public function printBatch(array $payload): array
    {
        return $this->transport->request('PUT', $this->basePath.'print-batch/', json: $payload, idempotent: true);
    }
}
