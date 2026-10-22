<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Address;
use FoundryCo\DualEntry\ValueObjects\Enums\PurchaseOrderBilledStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\PurchaseOrderLifecycleStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;
use FoundryCo\DualEntry\ValueObjects\TaxMetadata;
use FoundryCo\DualEntry\ValueObjects\TaxRegistrationNumbers;

/**
 * @method $this withDate(string $date)
 * @method $this withCompanyId(int $companyId)
 * @method $this withVendorId(int $vendorId)
 * @method $this withCurrencyIso4217Code(SystemCurrencies $currencyIso4217Code)
 * @method $this withExchangeRate(string $exchangeRate)
 * @method $this withMemo(string $memo)
 * @method $this withItems(array $items)
 * @method $this withShipFromAddress(?Address $shipFromAddress)
 * @method $this withShipToAddress(?Address $shipToAddress)
 * @method $this withTermId(?int $termId)
 * @method $this withTermName(?string $termName)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withApprovalStatus(?string $approvalStatus)
 * @method $this withNextApprovers(?array $nextApprovers)
 * @method $this withRejectedBy(?array $rejectedBy)
 * @method $this withInternalId(?int $internalId)
 * @method $this withNumber(?int $number)
 * @method $this withCode(?string $code)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCompanyCurrency(?string $companyCurrency)
 * @method $this withVendorName(?string $vendorName)
 * @method $this withBilledTotal(?string $billedTotal)
 * @method $this withDueTotal(?string $dueTotal)
 * @method $this withAmount(?string $amount)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withBilledStatus(?PurchaseOrderBilledStatus $billedStatus)
 * @method $this withLifecycleStatus(?PurchaseOrderLifecycleStatus $lifecycleStatus)
 * @method $this withReferenceNumber(?string $referenceNumber)
 * @method $this withExpectedLocationId(?int $expectedLocationId)
 * @method $this withExpectedLocationName(?string $expectedLocationName)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withSupplyDate(?string $supplyDate)
 * @method $this withPlaceOfSupply(?string $placeOfSupply)
 * @method $this withTaxRegistrationNumbers(?TaxRegistrationNumbers $taxRegistrationNumbers)
 * @method $this withTaxMetadata(?TaxMetadata $taxMetadata)
 */
final class PurchaseOrder
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly string $date,
        public readonly int $companyId,
        public readonly int $vendorId,
        public readonly SystemCurrencies $currencyIso4217Code,
        public readonly string $exchangeRate,
        public readonly string $memo,
        /** @var array<int, PurchaseOrderLineItem> */
        public readonly array $items,
        public readonly ?Address $shipFromAddress = null,
        public readonly ?Address $shipToAddress = null,
        public readonly ?int $termId = null,
        public readonly ?string $termName = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?string $approvalStatus = null,
        public readonly ?array $nextApprovers = null,
        public readonly ?array $rejectedBy = null,
        public readonly ?int $internalId = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?string $vendorName = null,
        public readonly ?string $billedTotal = null,
        public readonly ?string $dueTotal = null,
        public readonly ?string $amount = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?PurchaseOrderBilledStatus $billedStatus = null,
        public readonly ?PurchaseOrderLifecycleStatus $lifecycleStatus = null,
        public readonly ?string $referenceNumber = null,
        public readonly ?int $expectedLocationId = null,
        public readonly ?string $expectedLocationName = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?string $supplyDate = null,
        public readonly ?string $placeOfSupply = null,
        public readonly ?TaxRegistrationNumbers $taxRegistrationNumbers = null,
        public readonly ?TaxMetadata $taxMetadata = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created PurchaseOrder ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $date,
        int $companyId,
        int $vendorId,
        SystemCurrencies $currencyIso4217Code,
        string $exchangeRate,
        string $memo,
        /** @var array<int, PurchaseOrderLineItem> */
        array $items,
        ?Address $shipFromAddress = null,
        ?Address $shipToAddress = null,
        ?int $termId = null,
        ?RecordStatus $recordStatus = null,
        ?string $referenceNumber = null,
        ?int $expectedLocationId = null,
        ?string $supplyDate = null,
        ?string $placeOfSupply = null,
        ?TaxRegistrationNumbers $taxRegistrationNumbers = null,
        ?TaxMetadata $taxMetadata = null,
    ): self {
        return new self(
            date: $date,
            companyId: $companyId,
            vendorId: $vendorId,
            currencyIso4217Code: $currencyIso4217Code,
            exchangeRate: $exchangeRate,
            memo: $memo,
            items: $items,
            shipFromAddress: $shipFromAddress,
            shipToAddress: $shipToAddress,
            termId: $termId,
            termName: null,
            createdBy: null,
            updatedBy: null,
            approvalStatus: null,
            nextApprovers: null,
            rejectedBy: null,
            internalId: null,
            number: null,
            code: null,
            companyName: null,
            companyCurrency: null,
            vendorName: null,
            billedTotal: null,
            dueTotal: null,
            amount: null,
            recordStatus: $recordStatus,
            billedStatus: null,
            lifecycleStatus: null,
            referenceNumber: $referenceNumber,
            expectedLocationId: $expectedLocationId,
            expectedLocationName: null,
            createdAt: null,
            updatedAt: null,
            supplyDate: $supplyDate,
            placeOfSupply: $placeOfSupply,
            taxRegistrationNumbers: $taxRegistrationNumbers,
            taxMetadata: $taxMetadata,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            date: $data['date'],
            companyId: $data['company_id'],
            vendorId: $data['vendor_id'],
            currencyIso4217Code: SystemCurrencies::fromWire($data['currency_iso_4217_code']),
            exchangeRate: $data['exchange_rate'],
            memo: $data['memo'],
            items: array_map(static fn (array $row): PurchaseOrderLineItem => PurchaseOrderLineItem::fromWire($row), $data['items'] ?? []),
            shipFromAddress: isset($data['ship_from_address']) ? Address::fromWire($data['ship_from_address']) : null,
            shipToAddress: isset($data['ship_to_address']) ? Address::fromWire($data['ship_to_address']) : null,
            termId: $data['term_id'] ?? null,
            termName: $data['term_name'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            approvalStatus: $data['approval_status'] ?? null,
            nextApprovers: $data['next_approvers'] ?? null,
            rejectedBy: $data['rejected_by'] ?? null,
            internalId: $data['internal_id'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            vendorName: $data['vendor_name'] ?? null,
            billedTotal: $data['billed_total'] ?? null,
            dueTotal: $data['due_total'] ?? null,
            amount: $data['amount'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            billedStatus: isset($data['billed_status']) ? PurchaseOrderBilledStatus::fromWire($data['billed_status']) : null,
            lifecycleStatus: isset($data['lifecycle_status']) ? PurchaseOrderLifecycleStatus::fromWire($data['lifecycle_status']) : null,
            referenceNumber: $data['reference_number'] ?? null,
            expectedLocationId: $data['expected_location_id'] ?? null,
            expectedLocationName: $data['expected_location_name'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            supplyDate: $data['supply_date'] ?? null,
            placeOfSupply: $data['place_of_supply'] ?? null,
            taxRegistrationNumbers: isset($data['tax_registration_numbers']) ? TaxRegistrationNumbers::fromWire($data['tax_registration_numbers']) : null,
            taxMetadata: isset($data['tax_metadata']) ? TaxMetadata::fromWire($data['tax_metadata']) : null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'date' => $this->date,
            'company_id' => $this->companyId,
            'vendor_id' => $this->vendorId,
            'currency_iso_4217_code' => $this->currencyIso4217Code->toWire(),
            'exchange_rate' => $this->exchangeRate,
            'memo' => $this->memo,
            'items' => array_map(static fn (PurchaseOrderLineItem $row): array => $row->toWire(), $this->items),
            'ship_from_address' => $this->shipFromAddress?->toWire(),
            'ship_to_address' => $this->shipToAddress?->toWire(),
            'term_id' => $this->termId,
            'record_status' => $this->recordStatus?->toWire(),
            'reference_number' => $this->referenceNumber,
            'expected_location_id' => $this->expectedLocationId,
            'supply_date' => $this->supplyDate,
            'place_of_supply' => $this->placeOfSupply,
            'tax_registration_numbers' => $this->taxRegistrationNumbers?->toWire(),
            'tax_metadata' => $this->taxMetadata?->toWire(),
        ], static fn (mixed $value): bool => $value !== null);
    }
}
