<?php

namespace FoundryCo\DualEntry\Support;

use Generator;

/**
 * Walks a limit/offset list endpoint one page at a time.
 *
 * DualEntry list responses are a flat JSON array with no metadata envelope
 * (see https://docs.dualentry.com/developers/guides/api/core-concepts/pagination),
 * so the only reliable end-of-data signal is a page shorter than the
 * requested limit.
 *
 * @implements \IteratorAggregate<int, array<string, mixed>>
 */
final class Paginator implements \IteratorAggregate
{
    private const DEFAULT_LIMIT = 100;

    public function __construct(
        private readonly mixed $fetchPage,
        private readonly array $query = [],
        private readonly int $limit = self::DEFAULT_LIMIT,
    ) {}

    /**
     * Yields every record across all pages, lazily, in one flat stream.
     */
    public function records(): Generator
    {
        foreach ($this->pages() as $page) {
            yield from $page;
        }
    }

    /**
     * Yields each page (an array of records) as it's fetched.
     */
    public function pages(): Generator
    {
        $offset = (int) ($this->query['offset'] ?? 0);
        $limit = (int) ($this->query['limit'] ?? $this->limit);

        while (true) {
            $page = ($this->fetchPage)(array_merge($this->query, [
                'limit' => $limit,
                'offset' => $offset,
            ]));

            yield $page;

            if (count($page) < $limit) {
                return;
            }

            $offset += $limit;
        }
    }

    public function getIterator(): Generator
    {
        return $this->records();
    }
}
