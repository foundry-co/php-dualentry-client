<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\VatRateType;
use FoundryCo\DualEntry\ValueObjects\Enums\VatTaxType;

/**
 * @method $this withId(?int $id)
 * @method $this withCountryCode(?string $countryCode)
 * @method $this withName(?string $name)
 * @method $this withRate(?string $rate)
 * @method $this withRateType(?VatRateType $rateType)
 * @method $this withTaxType(?VatTaxType $taxType)
 * @method $this withValidFrom(?string $validFrom)
 * @method $this withValidTo(?string $validTo)
 * @method $this withIsActive(?bool $isActive)
 * @method $this withIsSystem(?bool $isSystem)
 * @method $this withDescription(?string $description)
 * @method $this withTaxAssetAccountId(?int $taxAssetAccountId)
 * @method $this withTaxLiabilityAccountId(?int $taxLiabilityAccountId)
 * @method $this withIsNonDeductible(?bool $isNonDeductible)
 * @method $this withDeductible(?string $deductible)
 * @method $this withNonDeductibleCostAccountId(?int $nonDeductibleCostAccountId)
 */
final class VatRate
{
    use ImmutableAttributes;

    private function __construct(
        public readonly ?int $id = null,
        public readonly ?string $countryCode = null,
        public readonly ?string $name = null,
        public readonly ?string $rate = null,
        public readonly ?VatRateType $rateType = null,
        public readonly ?VatTaxType $taxType = null,
        public readonly ?string $validFrom = null,
        public readonly ?string $validTo = null,
        public readonly ?bool $isActive = null,
        public readonly ?bool $isSystem = null,
        public readonly ?string $description = null,
        public readonly ?int $taxAssetAccountId = null,
        public readonly ?int $taxLiabilityAccountId = null,
        public readonly ?bool $isNonDeductible = null,
        public readonly ?string $deductible = null,
        public readonly ?int $nonDeductibleCostAccountId = null,
        public readonly bool $exists = false,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            countryCode: $data['country_code'] ?? null,
            name: $data['name'] ?? null,
            rate: $data['rate'] ?? null,
            rateType: isset($data['rate_type']) ? VatRateType::fromWire($data['rate_type']) : null,
            taxType: isset($data['tax_type']) ? VatTaxType::fromWire($data['tax_type']) : null,
            validFrom: $data['valid_from'] ?? null,
            validTo: $data['valid_to'] ?? null,
            isActive: $data['is_active'] ?? null,
            isSystem: $data['is_system'] ?? null,
            description: $data['description'] ?? null,
            taxAssetAccountId: $data['tax_asset_account_id'] ?? null,
            taxLiabilityAccountId: $data['tax_liability_account_id'] ?? null,
            isNonDeductible: $data['is_non_deductible'] ?? null,
            deductible: $data['deductible'] ?? null,
            nonDeductibleCostAccountId: $data['non_deductible_cost_account_id'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([

        ], static fn (mixed $value): bool => $value !== null);
    }
}
