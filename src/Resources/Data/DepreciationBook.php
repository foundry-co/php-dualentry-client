<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;

/**
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withId(?int $id)
 * @method $this withCode(?string $code)
 * @method $this withName(?string $name)
 * @method $this withDescription(?string $description)
 * @method $this withIsActive(?bool $isActive)
 * @method $this withIsPosting(?bool $isPosting)
 */
final class DepreciationBook
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?string $name = null,
        public readonly ?string $description = null,
        public readonly ?bool $isActive = null,
        public readonly ?bool $isPosting = null,
        public readonly bool $exists = false,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            id: $data['id'] ?? null,
            code: $data['code'] ?? null,
            name: $data['name'] ?? null,
            description: $data['description'] ?? null,
            isActive: $data['is_active'] ?? null,
            isPosting: $data['is_posting'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([

        ], static fn (mixed $value): bool => $value !== null);
    }
}
