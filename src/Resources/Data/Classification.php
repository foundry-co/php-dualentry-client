<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;

/**
 * @method $this withName(string $name)
 * @method $this withIsActive(bool $isActive)
 * @method $this withSelections(array $selections)
 * @method $this withRequiredForRecords(array $requiredForRecords)
 * @method $this withParentId(int $parentId)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withId(?int $id)
 * @method $this withCode(?string $code)
 * @method $this withParentName(?string $parentName)
 */
final class Classification
{
    use ImmutableAttributes;

    private function __construct(
        public readonly string $name,
        public readonly bool $isActive,
        public readonly array $selections,
        public readonly array $requiredForRecords,
        public readonly int $parentId,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?string $parentName = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created Classification ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $name,
        bool $isActive,
        array $selections,
        array $requiredForRecords,
        int $parentId,
        ?int $id = null,
    ): self {
        return new self(
            name: $name,
            isActive: $isActive,
            selections: $selections,
            requiredForRecords: $requiredForRecords,
            parentId: $parentId,
            createdAt: null,
            updatedAt: null,
            createdBy: null,
            updatedBy: null,
            id: $id,
            code: null,
            parentName: null,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            name: $data['name'],
            isActive: $data['is_active'],
            selections: $data['selections'],
            requiredForRecords: $data['required_for_records'],
            parentId: $data['parent_id'],
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            id: $data['id'] ?? null,
            code: $data['code'] ?? null,
            parentName: $data['parent_name'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'name' => $this->name,
            'is_active' => $this->isActive,
            'selections' => $this->selections,
            'required_for_records' => $this->requiredForRecords,
            'parent_id' => $this->parentId,
            'id' => $this->id,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
