<?php

namespace FoundryCo\DualEntry\Resources;

use FoundryCo\DualEntry\Transport\Transport;

/**
 * Array-based transport primitives shared by every DualEntry resource.
 *
 * Concrete resource classes declare their own public, typed methods on top
 * of these (`create(InvoicePayload $payload): Invoice`, etc.) — PHP doesn't
 * allow a subclass to narrow an inherited method's parameter type, so a
 * generic `create(array $payload)` here couldn't become a typed one by
 * inheritance alone.
 */
abstract class AbstractResource
{
    /**
     * The resource's base path, relative to `/public/v2/`, e.g. `invoices/`.
     */
    protected string $basePath;

    public function __construct(protected readonly Transport $transport) {}

    /**
     * List responses are `{"items": [...], "count": N}`; this unwraps to
     * just the records for the page.
     *
     * @return array<int, array<string, mixed>>
     */
    protected function performList(array $query = []): array
    {
        $response = $this->transport->request('GET', $this->basePath, query: $query);

        return $response['items'] ?? [];
    }

    protected function performFind(int|string $id): array
    {
        return $this->transport->request('GET', $this->itemPath($id));
    }

    protected function performCreate(array $payload): array
    {
        return $this->transport->request('POST', $this->basePath, json: $payload, idempotent: true);
    }

    protected function performReplace(int|string $id, array $payload): array
    {
        return $this->transport->request('PUT', $this->itemPath($id), json: $payload, idempotent: true);
    }

    protected function performUpdate(int|string $id, array $payload): array
    {
        return $this->transport->request('PATCH', $this->itemPath($id), json: $payload, idempotent: true);
    }

    protected function performDelete(int|string $id): void
    {
        $this->transport->request('DELETE', $this->itemPath($id), idempotent: true);
    }

    /**
     * @return array<int, array<string, mixed>>
     */
    protected function performLines(int|string $id, array $query = []): array
    {
        $response = $this->transport->request('GET', $this->itemPath($id).'lines/', query: $query);

        return $response['items'] ?? [];
    }

    /**
     * @param  array<int, string>  $filePaths  Local filesystem paths of the files to upload.
     */
    protected function performUploadAttachments(int|string $id, array $filePaths): array
    {
        return $this->transport->request(
            'POST',
            $this->itemPath($id).'attachments/',
            multipart: $this->filesToMultipart($filePaths),
            idempotent: true,
        );
    }

    protected function itemPath(int|string $id): string
    {
        return $this->basePath.rawurlencode((string) $id).'/';
    }

    protected function filesToMultipart(array $filePaths): array
    {
        return array_map(
            static fn (string $path): array => [
                'name' => 'files',
                'contents' => fopen($path, 'rb'),
                'filename' => basename($path),
            ],
            $filePaths,
        );
    }
}
