<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\Webhook;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Outbound webhook subscriptions.
 */
final class WebhookResource extends AbstractResource
{
    protected string $basePath = 'webhooks/';

    /**
     * @return array<int, Webhook>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): Webhook => Webhook::fromWire($row),
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

    public function find(int|string $id): Webhook
    {
        return Webhook::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via Webhook::make(...).
     */
    public function create(Webhook $record): Webhook
    {
        return Webhook::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, Webhook $record): Webhook
    {
        return Webhook::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * Partial update (PATCH) — a plain array of wire-format (snake_case)
     * fields to change; anything you don't include stays as it is.
     */
    public function update(int|string $id, array $fields): Webhook
    {
        return Webhook::fromWire($this->performUpdate($id, $fields));
    }

    public function delete(int|string $id): void
    {
        $this->performDelete($id);
    }

    /**
     * The event topics available to subscribe to.
     */
    public function topics(): array
    {
        return $this->transport->request('GET', $this->basePath.'topics/');
    }

    /**
     * Delivery attempts for a webhook subscription.
     */
    public function deliveries(string $webhookUuid, array $query = []): array
    {
        $response = $this->transport->request('GET', $this->itemPath($webhookUuid).'deliveries/', query: $query);

        return $response['items'] ?? [];
    }
}
