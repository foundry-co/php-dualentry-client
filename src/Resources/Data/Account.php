<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\AccountType;
use FoundryCo\DualEntry\ValueObjects\Enums\Category1099;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemAccountNames;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;

/**
 * @method $this withName(string $name)
 * @method $this withNumber(int $number)
 * @method $this withAccountType(AccountType $accountType)
 * @method $this withCurrencyIso4217Code(?SystemCurrencies $currencyIso4217Code)
 * @method $this withIsActive(bool $isActive)
 * @method $this withParentAccountId(?int $parentAccountId)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withId(?int $id)
 * @method $this withDescription(?string $description)
 * @method $this withIsSystem(?bool $isSystem)
 * @method $this withCompanyId(?int $companyId)
 * @method $this withCategory1099(?Category1099 $category1099)
 * @method $this withSystemRef(?SystemAccountNames $systemRef)
 * @method $this withAllowedCompanyIds(?array $allowedCompanyIds)
 * @method $this withIsMonetary(?bool $isMonetary)
 * @method $this withBankAlias(?string $bankAlias)
 * @method $this withBankRouting(?string $bankRouting)
 * @method $this withBankAccountNumber(?string $bankAccountNumber)
 * @method $this withIban(?string $iban)
 * @method $this withStartBankMatchDate(?string $startBankMatchDate)
 */
final class Account
{
    use ImmutableAttributes;

    private function __construct(
        public readonly string $name,
        public readonly int $number,
        public readonly AccountType $accountType,
        public readonly ?SystemCurrencies $currencyIso4217Code,
        public readonly bool $isActive,
        public readonly ?int $parentAccountId,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?int $id = null,
        public readonly ?string $description = null,
        public readonly ?bool $isSystem = null,
        public readonly ?int $companyId = null,
        public readonly ?Category1099 $category1099 = null,
        public readonly ?SystemAccountNames $systemRef = null,
        public readonly ?array $allowedCompanyIds = null,
        public readonly ?bool $isMonetary = null,
        public readonly ?string $bankAlias = null,
        public readonly ?string $bankRouting = null,
        public readonly ?string $bankAccountNumber = null,
        public readonly ?string $iban = null,
        public readonly ?string $startBankMatchDate = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created Account ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $name,
        int $number,
        AccountType $accountType,
        ?SystemCurrencies $currencyIso4217Code,
        bool $isActive,
        ?int $parentAccountId = null,
        ?string $description = null,
        ?int $companyId = null,
        ?Category1099 $category1099 = null,
        ?array $allowedCompanyIds = null,
        ?bool $isMonetary = null,
        ?string $bankAlias = null,
        ?string $bankRouting = null,
        ?string $bankAccountNumber = null,
        ?string $iban = null,
        ?string $startBankMatchDate = null,
    ): self {
        return new self(
            name: $name,
            number: $number,
            accountType: $accountType,
            currencyIso4217Code: $currencyIso4217Code,
            isActive: $isActive,
            parentAccountId: $parentAccountId,
            createdAt: null,
            updatedAt: null,
            createdBy: null,
            updatedBy: null,
            id: null,
            description: $description,
            isSystem: null,
            companyId: $companyId,
            category1099: $category1099,
            systemRef: null,
            allowedCompanyIds: $allowedCompanyIds,
            isMonetary: $isMonetary,
            bankAlias: $bankAlias,
            bankRouting: $bankRouting,
            bankAccountNumber: $bankAccountNumber,
            iban: $iban,
            startBankMatchDate: $startBankMatchDate,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            name: $data['name'],
            number: $data['number'],
            accountType: AccountType::fromWire($data['account_type']),
            currencyIso4217Code: ($data['currency_iso_4217_code'] ?? '') !== '' ? SystemCurrencies::fromWire($data['currency_iso_4217_code']) : null,
            isActive: $data['is_active'],
            parentAccountId: $data['parent_account_id'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            id: $data['id'] ?? null,
            description: $data['description'] ?? null,
            isSystem: $data['is_system'] ?? null,
            companyId: $data['company_id'] ?? null,
            category1099: ($data['category_1099'] ?? '') !== '' ? Category1099::fromWire($data['category_1099']) : null,
            systemRef: isset($data['system_ref']) ? SystemAccountNames::fromWire($data['system_ref']) : null,
            allowedCompanyIds: $data['allowed_company_ids'] ?? null,
            isMonetary: $data['is_monetary'] ?? null,
            bankAlias: $data['bank_alias'] ?? null,
            bankRouting: $data['bank_routing'] ?? null,
            bankAccountNumber: $data['bank_account_number'] ?? null,
            iban: $data['iban'] ?? null,
            startBankMatchDate: $data['start_bank_match_date'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'name' => $this->name,
            'number' => $this->number,
            'account_type' => $this->accountType->toWire(),
            'currency_iso_4217_code' => $this->currencyIso4217Code?->toWire(),
            'is_active' => $this->isActive,
            'parent_account_id' => $this->parentAccountId,
            'description' => $this->description,
            'company_id' => $this->companyId,
            'category_1099' => $this->category1099?->toWire(),
            'allowed_company_ids' => $this->allowedCompanyIds,
            'is_monetary' => $this->isMonetary,
            'bank_alias' => $this->bankAlias,
            'bank_routing' => $this->bankRouting,
            'bank_account_number' => $this->bankAccountNumber,
            'iban' => $this->iban,
            'start_bank_match_date' => $this->startBankMatchDate,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
