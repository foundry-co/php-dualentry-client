<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Address;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;

/**
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withVatRegistrationNumbers(?array $vatRegistrationNumbers)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withId(?int $id)
 * @method $this withCode(?string $code)
 * @method $this withName(?string $name)
 * @method $this withParentCompanyId(?int $parentCompanyId)
 * @method $this withCurrencyIso4217Code(?SystemCurrencies $currencyIso4217Code)
 * @method $this withAddress(?Address $address)
 * @method $this withTin(?string $tin)
 * @method $this withTinType(?string $tinType)
 * @method $this withIsActive(?bool $isActive)
 * @method $this withIsElimination(?bool $isElimination)
 * @method $this withFiscalYearEndMonth(?int $fiscalYearEndMonth)
 */
final class Company
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?array $vatRegistrationNumbers = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?string $name = null,
        public readonly ?int $parentCompanyId = null,
        public readonly ?SystemCurrencies $currencyIso4217Code = null,
        public readonly ?Address $address = null,
        public readonly ?string $tin = null,
        public readonly ?string $tinType = null,
        public readonly ?bool $isActive = null,
        public readonly ?bool $isElimination = null,
        public readonly ?int $fiscalYearEndMonth = null,
        public readonly bool $exists = false,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            vatRegistrationNumbers: $data['vat_registration_numbers'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            id: $data['id'] ?? null,
            code: $data['code'] ?? null,
            name: $data['name'] ?? null,
            parentCompanyId: $data['parent_company_id'] ?? null,
            currencyIso4217Code: isset($data['currency_iso_4217_code']) ? SystemCurrencies::fromWire($data['currency_iso_4217_code']) : null,
            address: isset($data['address']) ? Address::fromWire($data['address']) : null,
            tin: $data['tin'] ?? null,
            tinType: $data['tin_type'] ?? null,
            isActive: $data['is_active'] ?? null,
            isElimination: $data['is_elimination'] ?? null,
            fiscalYearEndMonth: $data['fiscal_year_end_month'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([

        ], static fn (mixed $value): bool => $value !== null);
    }
}
