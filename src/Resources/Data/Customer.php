<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Address;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;

/**
 * @method $this withName(string $name)
 * @method $this withEmail(string $email)
 * @method $this withAddress(string $address)
 * @method $this withCountry(string $country)
 * @method $this withPhone(string $phone)
 * @method $this withWebsite(string $website)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withCustomFields(?array $customFields)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withApprovalStatus(?string $approvalStatus)
 * @method $this withNextApprovers(?array $nextApprovers)
 * @method $this withRejectedBy(?array $rejectedBy)
 * @method $this withId(?int $id)
 * @method $this withCode(?string $code)
 * @method $this withUniqueId(?string $uniqueId)
 * @method $this withCustomerType(?string $customerType)
 * @method $this withIsActive(?bool $isActive)
 * @method $this withRecordStatus(?string $recordStatus)
 * @method $this withIsTaxable(?bool $isTaxable)
 * @method $this withDefaultTaxCode(?string $defaultTaxCode)
 * @method $this withTaxRegistrationNumber(?string $taxRegistrationNumber)
 * @method $this withDefaultCurrency(?SystemCurrencies $defaultCurrency)
 * @method $this withShippingAddress(?Address $shippingAddress)
 * @method $this withAllowedCompanyIds(?array $allowedCompanyIds)
 * @method $this withFullAddress(?Address $fullAddress)
 */
final class Customer
{
    use ImmutableAttributes;

    private function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $address,
        public readonly string $country,
        public readonly string $phone,
        public readonly string $website,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?array $customFields = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?string $approvalStatus = null,
        public readonly ?array $nextApprovers = null,
        public readonly ?array $rejectedBy = null,
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?string $uniqueId = null,
        public readonly ?string $customerType = null,
        public readonly ?bool $isActive = null,
        public readonly ?string $recordStatus = null,
        public readonly ?bool $isTaxable = null,
        public readonly ?string $defaultTaxCode = null,
        public readonly ?string $taxRegistrationNumber = null,
        public readonly ?SystemCurrencies $defaultCurrency = null,
        public readonly ?Address $shippingAddress = null,
        public readonly ?array $allowedCompanyIds = null,
        public readonly ?Address $fullAddress = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created Customer ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $name,
        string $email,
        string $address,
        string $country,
        string $phone,
        string $website,
        ?array $customFields = null,
        ?string $uniqueId = null,
        ?bool $isActive = null,
        ?string $recordStatus = null,
        ?bool $isTaxable = null,
        ?Address $shippingAddress = null,
        ?array $allowedCompanyIds = null,
        ?Address $fullAddress = null,
    ): self {
        return new self(
            name: $name,
            email: $email,
            address: $address,
            country: $country,
            phone: $phone,
            website: $website,
            createdAt: null,
            updatedAt: null,
            customFields: $customFields,
            createdBy: null,
            updatedBy: null,
            approvalStatus: null,
            nextApprovers: null,
            rejectedBy: null,
            id: null,
            code: null,
            uniqueId: $uniqueId,
            customerType: null,
            isActive: $isActive,
            recordStatus: $recordStatus,
            isTaxable: $isTaxable,
            defaultTaxCode: null,
            taxRegistrationNumber: null,
            defaultCurrency: null,
            shippingAddress: $shippingAddress,
            allowedCompanyIds: $allowedCompanyIds,
            fullAddress: $fullAddress,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            name: $data['name'],
            email: $data['email'],
            address: $data['address'],
            country: $data['country'],
            phone: $data['phone'],
            website: $data['website'],
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            customFields: $data['custom_fields'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            approvalStatus: $data['approval_status'] ?? null,
            nextApprovers: $data['next_approvers'] ?? null,
            rejectedBy: $data['rejected_by'] ?? null,
            id: $data['id'] ?? null,
            code: $data['code'] ?? null,
            uniqueId: $data['unique_id'] ?? null,
            customerType: $data['customer_type'] ?? null,
            isActive: $data['is_active'] ?? null,
            recordStatus: $data['record_status'] ?? null,
            isTaxable: $data['is_taxable'] ?? null,
            defaultTaxCode: $data['default_tax_code'] ?? null,
            taxRegistrationNumber: $data['tax_registration_number'] ?? null,
            defaultCurrency: ($data['default_currency'] ?? '') !== '' ? SystemCurrencies::fromWire($data['default_currency']) : null,
            shippingAddress: isset($data['shipping_address']) ? Address::fromWire($data['shipping_address']) : null,
            allowedCompanyIds: $data['allowed_company_ids'] ?? null,
            fullAddress: isset($data['full_address']) ? Address::fromWire($data['full_address']) : null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'name' => $this->name,
            'email' => $this->email,
            'address' => $this->address,
            'country' => $this->country,
            'phone' => $this->phone,
            'website' => $this->website,
            'custom_fields' => $this->customFields,
            'unique_id' => $this->uniqueId,
            'is_active' => $this->isActive,
            'record_status' => $this->recordStatus,
            'is_taxable' => $this->isTaxable,
            'shipping_address' => $this->shippingAddress?->toWire(),
            'allowed_company_ids' => $this->allowedCompanyIds,
            'full_address' => $this->fullAddress?->toWire(),
        ], static fn (mixed $value): bool => $value !== null);
    }
}
