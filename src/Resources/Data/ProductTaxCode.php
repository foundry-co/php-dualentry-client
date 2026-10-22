<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\Sources;

/**
 * @method $this withCode(string $code)
 * @method $this withDescription(string $description)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withId(?int $id)
 * @method $this withSource(?Sources $source)
 * @method $this withIsActive(?bool $isActive)
 * @method $this withIsGlobal(?bool $isGlobal)
 */
final class ProductTaxCode
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly string $code,
        public readonly string $description,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?int $id = null,
        public readonly ?Sources $source = null,
        public readonly ?bool $isActive = null,
        public readonly ?bool $isGlobal = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created ProductTaxCode ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $code,
        string $description,
        ?Sources $source = null,
        ?bool $isActive = null,
    ): self {
        return new self(
            code: $code,
            description: $description,
            createdAt: null,
            updatedAt: null,
            id: null,
            source: $source,
            isActive: $isActive,
            isGlobal: null,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            code: $data['code'],
            description: $data['description'],
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            id: $data['id'] ?? null,
            source: isset($data['source']) ? Sources::fromWire($data['source']) : null,
            isActive: $data['is_active'] ?? null,
            isGlobal: $data['is_global'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'code' => $this->code,
            'description' => $this->description,
            'source' => $this->source?->toWire(),
            'is_active' => $this->isActive,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
