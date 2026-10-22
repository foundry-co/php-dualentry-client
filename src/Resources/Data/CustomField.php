<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\FieldType;

/**
 * @method $this withName(string $name)
 * @method $this withFieldType(FieldType $fieldType)
 * @method $this withAppliesTo(array $appliesTo)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withId(?int $id)
 * @method $this withCompanyId(?int $companyId)
 * @method $this withCompanyIds(?array $companyIds)
 * @method $this withDescription(?string $description)
 * @method $this withHelperText(?string $helperText)
 * @method $this withDefaultValue(?string $defaultValue)
 * @method $this withOptions(?array $options)
 * @method $this withIsActive(?bool $isActive)
 */
final class CustomField
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly string $name,
        public readonly FieldType $fieldType,
        public readonly array $appliesTo,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?int $id = null,
        public readonly ?int $companyId = null,
        public readonly ?array $companyIds = null,
        public readonly ?string $description = null,
        public readonly ?string $helperText = null,
        public readonly ?string $defaultValue = null,
        public readonly ?array $options = null,
        public readonly ?bool $isActive = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created CustomField ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $name,
        FieldType $fieldType,
        array $appliesTo,
        ?int $companyId = null,
        ?array $companyIds = null,
        ?string $description = null,
        ?string $helperText = null,
        ?string $defaultValue = null,
        ?array $options = null,
        ?bool $isActive = null,
    ): self {
        return new self(
            name: $name,
            fieldType: $fieldType,
            appliesTo: $appliesTo,
            createdAt: null,
            updatedAt: null,
            id: null,
            companyId: $companyId,
            companyIds: $companyIds,
            description: $description,
            helperText: $helperText,
            defaultValue: $defaultValue,
            options: $options,
            isActive: $isActive,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            name: $data['name'],
            fieldType: FieldType::fromWire($data['field_type']),
            appliesTo: $data['applies_to'],
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            id: $data['id'] ?? null,
            companyId: $data['company_id'] ?? null,
            companyIds: $data['company_ids'] ?? null,
            description: $data['description'] ?? null,
            helperText: $data['helper_text'] ?? null,
            defaultValue: $data['default_value'] ?? null,
            options: $data['options'] ?? null,
            isActive: $data['is_active'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'name' => $this->name,
            'field_type' => $this->fieldType->toWire(),
            'applies_to' => $this->appliesTo,
            'company_id' => $this->companyId,
            'company_ids' => $this->companyIds,
            'description' => $this->description,
            'helper_text' => $this->helperText,
            'default_value' => $this->defaultValue,
            'options' => $this->options,
            'is_active' => $this->isActive,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
