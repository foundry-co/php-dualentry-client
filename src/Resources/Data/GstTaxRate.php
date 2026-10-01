<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\GstSupplyCategory;
use FoundryCo\DualEntry\ValueObjects\Enums\GstTreatmentType;

/**
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withId(?int $id)
 * @method $this withCountryCode(?string $countryCode)
 * @method $this withName(?string $name)
 * @method $this withRate(?string $rate)
 * @method $this withTaxTreatment(?GstTreatmentType $taxTreatment)
 * @method $this withSupplyCategory(?GstSupplyCategory $supplyCategory)
 * @method $this withRegion(?string $region)
 * @method $this withValidFrom(?string $validFrom)
 * @method $this withValidTo(?string $validTo)
 * @method $this withIsActive(?bool $isActive)
 * @method $this withIsSystem(?bool $isSystem)
 * @method $this withDescription(?string $description)
 * @method $this withComponents(?array $components)
 */
final class GstTaxRate
{
    use ImmutableAttributes;

    private function __construct(
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?int $id = null,
        public readonly ?string $countryCode = null,
        public readonly ?string $name = null,
        public readonly ?string $rate = null,
        public readonly ?GstTreatmentType $taxTreatment = null,
        public readonly ?GstSupplyCategory $supplyCategory = null,
        public readonly ?string $region = null,
        public readonly ?string $validFrom = null,
        public readonly ?string $validTo = null,
        public readonly ?bool $isActive = null,
        public readonly ?bool $isSystem = null,
        public readonly ?string $description = null,
        public readonly ?array $components = null,
        public readonly bool $exists = false,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            id: $data['id'] ?? null,
            countryCode: $data['country_code'] ?? null,
            name: $data['name'] ?? null,
            rate: $data['rate'] ?? null,
            taxTreatment: isset($data['tax_treatment']) ? GstTreatmentType::fromWire($data['tax_treatment']) : null,
            supplyCategory: isset($data['supply_category']) ? GstSupplyCategory::fromWire($data['supply_category']) : null,
            region: $data['region'] ?? null,
            validFrom: $data['valid_from'] ?? null,
            validTo: $data['valid_to'] ?? null,
            isActive: $data['is_active'] ?? null,
            isSystem: $data['is_system'] ?? null,
            description: $data['description'] ?? null,
            components: $data['components'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([

        ], static fn (mixed $value): bool => $value !== null);
    }
}
