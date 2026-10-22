<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Address;
use FoundryCo\DualEntry\ValueObjects\Enums\BankAccountType;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCountries;

/**
 * @method $this withIsActive(bool $isActive)
 * @method $this withVendorType(string $vendorType)
 * @method $this withName(string $name)
 * @method $this withEmail(string $email)
 * @method $this withPhone(string $phone)
 * @method $this withWebsite(string $website)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withCustomFields(?array $customFields)
 * @method $this withTermId(?int $termId)
 * @method $this withTermName(?string $termName)
 * @method $this withPreferredPaymentMethodId(?int $preferredPaymentMethodId)
 * @method $this withPreferredPaymentMethodName(?string $preferredPaymentMethodName)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withApprovalStatus(?string $approvalStatus)
 * @method $this withNextApprovers(?array $nextApprovers)
 * @method $this withRejectedBy(?array $rejectedBy)
 * @method $this withId(?int $id)
 * @method $this withCode(?string $code)
 * @method $this withAddress(?Address $address)
 * @method $this withCompanyId(?int $companyId)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCustomerAccountNumber(?string $customerAccountNumber)
 * @method $this withNameOnCheck(?string $nameOnCheck)
 * @method $this withBankAccountNumber(?string $bankAccountNumber)
 * @method $this withBankRoutingNumber(?string $bankRoutingNumber)
 * @method $this withBankAccountType(?BankAccountType $bankAccountType)
 * @method $this withAllowedCompanyIds(?array $allowedCompanyIds)
 * @method $this withSingleAddress(?string $singleAddress)
 * @method $this withCountry(?SystemCountries $country)
 * @method $this withUniqueId(?string $uniqueId)
 * @method $this withIs1099Eligible(?bool $is1099Eligible)
 * @method $this withTin(?string $tin)
 * @method $this withTinType(?string $tinType)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 */
final class Vendor
{
    use HasDisplayId;
    use ImmutableAttributes;

    public const ID_PREFIX = 'VN';

    private function __construct(
        public readonly bool $isActive,
        public readonly string $vendorType,
        public readonly string $name,
        public readonly string $email,
        public readonly string $phone,
        public readonly string $website,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?array $customFields = null,
        public readonly ?int $termId = null,
        public readonly ?string $termName = null,
        public readonly ?int $preferredPaymentMethodId = null,
        public readonly ?string $preferredPaymentMethodName = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?string $approvalStatus = null,
        public readonly ?array $nextApprovers = null,
        public readonly ?array $rejectedBy = null,
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?Address $address = null,
        public readonly ?int $companyId = null,
        public readonly ?string $companyName = null,
        public readonly ?string $customerAccountNumber = null,
        public readonly ?string $nameOnCheck = null,
        public readonly ?string $bankAccountNumber = null,
        public readonly ?string $bankRoutingNumber = null,
        public readonly ?BankAccountType $bankAccountType = null,
        public readonly ?array $allowedCompanyIds = null,
        public readonly ?string $singleAddress = null,
        public readonly ?SystemCountries $country = null,
        public readonly ?string $uniqueId = null,
        public readonly ?bool $is1099Eligible = null,
        public readonly ?string $tin = null,
        public readonly ?string $tinType = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created Vendor ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        bool $isActive,
        string $vendorType,
        string $name,
        string $email,
        string $phone,
        string $website,
        ?array $customFields = null,
        ?int $termId = null,
        ?int $preferredPaymentMethodId = null,
        ?Address $address = null,
        ?string $customerAccountNumber = null,
        ?string $nameOnCheck = null,
        ?string $bankAccountNumber = null,
        ?string $bankRoutingNumber = null,
        ?BankAccountType $bankAccountType = null,
        ?array $allowedCompanyIds = null,
        ?string $singleAddress = null,
        ?SystemCountries $country = null,
        ?string $uniqueId = null,
        ?bool $is1099Eligible = null,
        ?string $tin = null,
        ?string $tinType = null,
        ?RecordStatus $recordStatus = null,
    ): self {
        return new self(
            isActive: $isActive,
            vendorType: $vendorType,
            name: $name,
            email: $email,
            phone: $phone,
            website: $website,
            createdAt: null,
            updatedAt: null,
            customFields: $customFields,
            termId: $termId,
            termName: null,
            preferredPaymentMethodId: $preferredPaymentMethodId,
            preferredPaymentMethodName: null,
            createdBy: null,
            updatedBy: null,
            approvalStatus: null,
            nextApprovers: null,
            rejectedBy: null,
            id: null,
            code: null,
            address: $address,
            companyId: null,
            companyName: null,
            customerAccountNumber: $customerAccountNumber,
            nameOnCheck: $nameOnCheck,
            bankAccountNumber: $bankAccountNumber,
            bankRoutingNumber: $bankRoutingNumber,
            bankAccountType: $bankAccountType,
            allowedCompanyIds: $allowedCompanyIds,
            singleAddress: $singleAddress,
            country: $country,
            uniqueId: $uniqueId,
            is1099Eligible: $is1099Eligible,
            tin: $tin,
            tinType: $tinType,
            recordStatus: $recordStatus,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            isActive: $data['is_active'],
            vendorType: $data['vendor_type'],
            name: $data['name'],
            email: $data['email'],
            phone: $data['phone'],
            website: $data['website'],
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            customFields: $data['custom_fields'] ?? null,
            termId: $data['term_id'] ?? null,
            termName: $data['term_name'] ?? null,
            preferredPaymentMethodId: $data['preferred_payment_method_id'] ?? null,
            preferredPaymentMethodName: $data['preferred_payment_method_name'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            approvalStatus: $data['approval_status'] ?? null,
            nextApprovers: $data['next_approvers'] ?? null,
            rejectedBy: $data['rejected_by'] ?? null,
            id: $data['id'] ?? null,
            code: $data['code'] ?? null,
            address: isset($data['address']) ? Address::fromWire($data['address']) : null,
            companyId: $data['company_id'] ?? null,
            companyName: $data['company_name'] ?? null,
            customerAccountNumber: $data['customer_account_number'] ?? null,
            nameOnCheck: $data['name_on_check'] ?? null,
            bankAccountNumber: $data['bank_account_number'] ?? null,
            bankRoutingNumber: $data['bank_routing_number'] ?? null,
            bankAccountType: ($data['bank_account_type'] ?? '') !== '' ? BankAccountType::fromWire($data['bank_account_type']) : null,
            allowedCompanyIds: $data['allowed_company_ids'] ?? null,
            singleAddress: $data['single_address'] ?? null,
            country: ($data['country'] ?? '') !== '' ? SystemCountries::fromWire($data['country']) : null,
            uniqueId: $data['unique_id'] ?? null,
            is1099Eligible: $data['is_1099_eligible'] ?? null,
            tin: $data['tin'] ?? null,
            tinType: $data['tin_type'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'is_active' => $this->isActive,
            'vendor_type' => $this->vendorType,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'website' => $this->website,
            'custom_fields' => $this->customFields,
            'term_id' => $this->termId,
            'preferred_payment_method_id' => $this->preferredPaymentMethodId,
            'address' => $this->address?->toWire(),
            'customer_account_number' => $this->customerAccountNumber,
            'name_on_check' => $this->nameOnCheck,
            'bank_account_number' => $this->bankAccountNumber,
            'bank_routing_number' => $this->bankRoutingNumber,
            'bank_account_type' => $this->bankAccountType?->toWire(),
            'allowed_company_ids' => $this->allowedCompanyIds,
            'single_address' => $this->singleAddress,
            'country' => $this->country?->toWire(),
            'unique_id' => $this->uniqueId,
            'is_1099_eligible' => $this->is1099Eligible,
            'tin' => $this->tin,
            'tin_type' => $this->tinType,
            'record_status' => $this->recordStatus?->toWire(),
        ], static fn (mixed $value): bool => $value !== null);
    }
}
