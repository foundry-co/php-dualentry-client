<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Resources\Data\Invoice;
use FoundryCo\DualEntry\Resources\Data\InvoiceLineItem;
use FoundryCo\DualEntry\Support\Paginator;

/**
 * Customer invoices.
 */
final class InvoiceResource extends AbstractResource
{
    protected string $basePath = 'invoices/';

    /**
     * @return array<int, Invoice>
     */
    public function list(array $filters = []): array
    {
        return array_map(
            static fn (array $row): Invoice => Invoice::fromWire($row),
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

    public function find(int|string $id): Invoice
    {
        return Invoice::fromWire($this->performFind($id));
    }

    /**
     * $record is typically built via Invoice::make(...).
     */
    public function create(Invoice $record): Invoice
    {
        return Invoice::fromWire($this->performCreate($record->toWire()));
    }

    /**
     * Full replace (PUT). $record is typically one you just fetched via
     * find(), tweaked with with()/withX(), and are sending back in full —
     * omitted fields are not merged server-side, they're reset to default.
     */
    public function replace(int|string $id, Invoice $record): Invoice
    {
        return Invoice::fromWire($this->performReplace($id, $record->toWire()));
    }

    /**
     * Partial update (PATCH) — a plain array of wire-format (snake_case)
     * fields to change; anything you don't include stays as it is.
     */
    public function update(int|string $id, array $fields): Invoice
    {
        return Invoice::fromWire($this->performUpdate($id, $fields));
    }

    /**
     * @return array<int, InvoiceLineItem>
     */
    public function lines(int|string $id, array $query = []): array
    {
        return array_map(
            static fn (array $row): InvoiceLineItem => InvoiceLineItem::fromWire($row),
            $this->performLines($id, $query),
        );
    }

    /**
     * @param  array<int, string>  $filePaths  Local filesystem paths of the files to upload.
     */
    public function uploadAttachments(int|string $id, array $filePaths): Invoice
    {
        return Invoice::fromWire($this->performUploadAttachments($id, $filePaths));
    }

    /**
     * Email the invoice to the customer.
     */
    public function send(int|string $id, array $payload = []): array
    {
        return $this->transport->request('POST', $this->itemPath($id).'send/', json: $payload, idempotent: true);
    }

    /**
     * Replace all attachments on the invoice in one call, rather than appending via {@see uploadAttachments()}.
     */
    public function replaceAttachments(int|string $id, array $filePaths): array
    {
        return $this->transport->request(
            'POST',
            $this->itemPath($id).'attachments/replace/',
            multipart: $this->filesToMultipart($filePaths),
            idempotent: true,
        );
    }
}
