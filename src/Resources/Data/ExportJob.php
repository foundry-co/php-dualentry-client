<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\PublicExportJobStatus;

/**
 * @method $this withId(?int $id)
 * @method $this withIntegrationId(?int $integrationId)
 * @method $this withStatus(?PublicExportJobStatus $status)
 * @method $this withError(?string $error)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withStartedAt(?string $startedAt)
 * @method $this withCompletedAt(?string $completedAt)
 */
final class ExportJob
{
    use ImmutableAttributes;

    private function __construct(
        public readonly ?int $id = null,
        public readonly ?int $integrationId = null,
        public readonly ?PublicExportJobStatus $status = null,
        public readonly ?string $error = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $startedAt = null,
        public readonly ?string $completedAt = null,
        public readonly bool $exists = false,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            integrationId: $data['integration_id'] ?? null,
            status: isset($data['status']) ? PublicExportJobStatus::fromWire($data['status']) : null,
            error: $data['error'] ?? null,
            createdAt: $data['created_at'] ?? null,
            startedAt: $data['started_at'] ?? null,
            completedAt: $data['completed_at'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([

        ], static fn (mixed $value): bool => $value !== null);
    }
}
