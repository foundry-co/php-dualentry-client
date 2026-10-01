<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Address;
use FoundryCo\DualEntry\ValueObjects\Enums\FixedAssetStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;
use FoundryCo\DualEntry\ValueObjects\RecordClassification;

/**
 * @method $this withCompanyId(int $companyId)
 * @method $this withName(string $name)
 * @method $this withCurrencyIso4217Code(SystemCurrencies $currencyIso4217Code)
 * @method $this withExchangeRate(string $exchangeRate)
 * @method $this withPurchaseDate(string $purchaseDate)
 * @method $this withCost(string $cost)
 * @method $this withAssetAccountNumber(int $assetAccountNumber)
 * @method $this withExpenseAccountNumber(int $expenseAccountNumber)
 * @method $this withAccumulationAccountNumber(int $accumulationAccountNumber)
 * @method $this withDepreciationSchedules(array $depreciationSchedules)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withCustomFields(?array $customFields)
 * @method $this withApprovalStatus(?string $approvalStatus)
 * @method $this withNextApprovers(?array $nextApprovers)
 * @method $this withRejectedBy(?array $rejectedBy)
 * @method $this withInternalId(?int $internalId)
 * @method $this withNumber(?int $number)
 * @method $this withCode(?string $code)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withSerialNumber(?string $serialNumber)
 * @method $this withMemo(?string $memo)
 * @method $this withStatus(?FixedAssetStatus $status)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withVendorId(?int $vendorId)
 * @method $this withVendorName(?string $vendorName)
 * @method $this withCustomerId(?int $customerId)
 * @method $this withCustomerName(?string $customerName)
 * @method $this withFixedAssetClassId(?int $fixedAssetClassId)
 * @method $this withAddress(?Address $address)
 * @method $this withClassifications(?array $classifications)
 * @method $this withSourceLines(?array $sourceLines)
 */
final class FixedAsset
{
    use ImmutableAttributes;

    private function __construct(
        public readonly int $companyId,
        public readonly string $name,
        public readonly SystemCurrencies $currencyIso4217Code,
        public readonly string $exchangeRate,
        public readonly string $purchaseDate,
        public readonly string $cost,
        public readonly int $assetAccountNumber,
        public readonly int $expenseAccountNumber,
        public readonly int $accumulationAccountNumber,
        public readonly array $depreciationSchedules,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?array $customFields = null,
        public readonly ?string $approvalStatus = null,
        public readonly ?array $nextApprovers = null,
        public readonly ?array $rejectedBy = null,
        public readonly ?int $internalId = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        public readonly ?string $companyName = null,
        public readonly ?string $serialNumber = null,
        public readonly ?string $memo = null,
        public readonly ?FixedAssetStatus $status = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?int $vendorId = null,
        public readonly ?string $vendorName = null,
        public readonly ?int $customerId = null,
        public readonly ?string $customerName = null,
        public readonly ?int $fixedAssetClassId = null,
        public readonly ?Address $address = null,
        /** @var array<int, RecordClassification> */
        public readonly ?array $classifications = null,
        public readonly ?array $sourceLines = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created FixedAsset ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        int $companyId,
        string $name,
        SystemCurrencies $currencyIso4217Code,
        string $exchangeRate,
        string $purchaseDate,
        string $cost,
        int $assetAccountNumber,
        int $expenseAccountNumber,
        int $accumulationAccountNumber,
        array $depreciationSchedules,
        ?array $customFields = null,
        ?string $serialNumber = null,
        ?string $memo = null,
        ?FixedAssetStatus $status = null,
        ?RecordStatus $recordStatus = null,
        ?int $vendorId = null,
        ?int $customerId = null,
        ?int $fixedAssetClassId = null,
        ?Address $address = null,
        /** @var array<int, RecordClassification> */
        ?array $classifications = null,
        ?array $sourceLines = null,
    ): self {
        return new self(
            companyId: $companyId,
            name: $name,
            currencyIso4217Code: $currencyIso4217Code,
            exchangeRate: $exchangeRate,
            purchaseDate: $purchaseDate,
            cost: $cost,
            assetAccountNumber: $assetAccountNumber,
            expenseAccountNumber: $expenseAccountNumber,
            accumulationAccountNumber: $accumulationAccountNumber,
            depreciationSchedules: $depreciationSchedules,
            createdBy: null,
            updatedBy: null,
            customFields: $customFields,
            approvalStatus: null,
            nextApprovers: null,
            rejectedBy: null,
            internalId: null,
            number: null,
            code: null,
            companyName: null,
            serialNumber: $serialNumber,
            memo: $memo,
            status: $status,
            recordStatus: $recordStatus,
            vendorId: $vendorId,
            vendorName: null,
            customerId: $customerId,
            customerName: null,
            fixedAssetClassId: $fixedAssetClassId,
            address: $address,
            classifications: $classifications,
            sourceLines: $sourceLines,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            companyId: $data['company_id'],
            name: $data['name'],
            currencyIso4217Code: SystemCurrencies::fromWire($data['currency_iso_4217_code']),
            exchangeRate: $data['exchange_rate'],
            purchaseDate: $data['purchase_date'],
            cost: $data['cost'],
            assetAccountNumber: $data['asset_account_number'],
            expenseAccountNumber: $data['expense_account_number'],
            accumulationAccountNumber: $data['accumulation_account_number'],
            depreciationSchedules: $data['depreciation_schedules'],
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            customFields: $data['custom_fields'] ?? null,
            approvalStatus: $data['approval_status'] ?? null,
            nextApprovers: $data['next_approvers'] ?? null,
            rejectedBy: $data['rejected_by'] ?? null,
            internalId: $data['internal_id'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            companyName: $data['company_name'] ?? null,
            serialNumber: $data['serial_number'] ?? null,
            memo: $data['memo'] ?? null,
            status: isset($data['status']) ? FixedAssetStatus::fromWire($data['status']) : null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            vendorId: $data['vendor_id'] ?? null,
            vendorName: $data['vendor_name'] ?? null,
            customerId: $data['customer_id'] ?? null,
            customerName: $data['customer_name'] ?? null,
            fixedAssetClassId: $data['fixed_asset_class_id'] ?? null,
            address: isset($data['address']) ? Address::fromWire($data['address']) : null,
            classifications: array_map(static fn (array $row): RecordClassification => RecordClassification::fromWire($row), $data['classifications'] ?? []),
            sourceLines: $data['source_lines'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'company_id' => $this->companyId,
            'name' => $this->name,
            'currency_iso_4217_code' => $this->currencyIso4217Code->toWire(),
            'exchange_rate' => $this->exchangeRate,
            'purchase_date' => $this->purchaseDate,
            'cost' => $this->cost,
            'asset_account_number' => $this->assetAccountNumber,
            'expense_account_number' => $this->expenseAccountNumber,
            'accumulation_account_number' => $this->accumulationAccountNumber,
            'depreciation_schedules' => $this->depreciationSchedules,
            'custom_fields' => $this->customFields,
            'serial_number' => $this->serialNumber,
            'memo' => $this->memo,
            'status' => $this->status?->toWire(),
            'record_status' => $this->recordStatus?->toWire(),
            'vendor_id' => $this->vendorId,
            'customer_id' => $this->customerId,
            'fixed_asset_class_id' => $this->fixedAssetClassId,
            'address' => $this->address?->toWire(),
            'classifications' => array_map(static fn (RecordClassification $row): array => $row->toWire(), $this->classifications),
            'source_lines' => $this->sourceLines,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
