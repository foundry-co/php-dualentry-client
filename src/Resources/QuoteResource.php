<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\Quote;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Sales quotes.
 */
final class QuoteResource extends AbstractResource
{
    protected string $basePath = 'quotes/';

    /**
     * @return array<int, Quote>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): Quote => Quote::fromWire($row),
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

    public function find(int|string $id): Quote
    {
        return Quote::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via Quote::make(...).
     */
    public function create(Quote $record): Quote
    {
        return Quote::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, Quote $record): Quote
    {
        return Quote::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * Partial update (PATCH) — a plain array of wire-format (snake_case)
     * fields to change; anything you don't include stays as it is.
     */
    public function update(int|string $id, array $fields): Quote
    {
        return Quote::fromWire($this->performUpdate($id, $fields));
    }

    /**
     * Email the quote to the customer.
     */
    public function send(int|string $id, array $payload = []): array
    {
        return $this->transport->request('POST', $this->itemPath($id).'send/', json: $payload, idempotent: true);
    }
}
