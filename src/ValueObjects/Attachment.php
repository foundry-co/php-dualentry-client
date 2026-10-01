<?php

namespace FoundryCo\DualEntry\ValueObjects;

use FoundryCo\DualEntry\Resources\AbstractResource;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;

/**
 * Always a response shape — attachments are written via
 * {@see AbstractResource::uploadAttachments()},
 * which takes local file paths, not this object.
 */
final class Attachment
{
    use ImmutableAttributes;

    public function __construct(
        public readonly int $id,
        public readonly string $fileName,
        public readonly int $fileSize,
        public readonly string $category,
        public readonly ?string $downloadUrl = null,
        public readonly ?string $uploadUrl = null,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            id: $data['id'],
            fileName: $data['file_name'],
            fileSize: $data['file_size'],
            category: $data['category'] ?? '',
            downloadUrl: $data['download_url'] ?? null,
            uploadUrl: $data['upload_url'] ?? null,
        );
    }
}
