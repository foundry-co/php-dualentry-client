<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Address;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\RecordClassification;
use FoundryCo\DualEntry\ValueObjects\TaxMetadata;
use FoundryCo\DualEntry\ValueObjects\TaxRegistrationNumbers;

/**
 * @method $this withDate(string $date)
 * @method $this withVendorId(int $vendorId)
 * @method $this withCompanyId(int $companyId)
 * @method $this withCurrencyIso4217Code(string $currencyIso4217Code)
 * @method $this withExchangeRate(string $exchangeRate)
 * @method $this withCustomFields(?array $customFields)
 * @method $this withShipFromAddress(?Address $shipFromAddress)
 * @method $this withShipToAddress(?Address $shipToAddress)
 * @method $this withSupplyDate(?string $supplyDate)
 * @method $this withPlaceOfSupply(?string $placeOfSupply)
 * @method $this withTaxRegistrationNumbers(?TaxRegistrationNumbers $taxRegistrationNumbers)
 * @method $this withTaxMetadata(?TaxMetadata $taxMetadata)
 * @method $this withTax(?array $tax)
 * @method $this withClassifications(?array $classifications)
 * @method $this withTransactionIds(?array $transactionIds)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withInternalId(?int $internalId)
 * @method $this withNumber(?int $number)
 * @method $this withCode(?string $code)
 * @method $this withBillNumber(?int $billNumber)
 * @method $this withDirectExpenseNumber(?int $directExpenseNumber)
 * @method $this withTransactionDate(?string $transactionDate)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCompanyCurrency(?string $companyCurrency)
 * @method $this withVendorName(?string $vendorName)
 * @method $this withMemo(?string $memo)
 * @method $this withItems(?array $items)
 * @method $this withExpenses(?array $expenses)
 * @method $this withAmount(?string $amount)
 * @method $this withUsedAmount(?string $usedAmount)
 * @method $this withRemainingAmount(?string $remainingAmount)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 */
final class VendorCredit
{
    use ImmutableAttributes;

    private function __construct(
        public readonly string $date,
        public readonly int $vendorId,
        public readonly int $companyId,
        public readonly string $currencyIso4217Code,
        public readonly string $exchangeRate,
        public readonly ?array $customFields = null,
        public readonly ?Address $shipFromAddress = null,
        public readonly ?Address $shipToAddress = null,
        public readonly ?string $supplyDate = null,
        public readonly ?string $placeOfSupply = null,
        public readonly ?TaxRegistrationNumbers $taxRegistrationNumbers = null,
        public readonly ?TaxMetadata $taxMetadata = null,
        public readonly ?array $tax = null,
        /** @var array<int, RecordClassification> */
        public readonly ?array $classifications = null,
        public readonly ?array $transactionIds = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?int $internalId = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        public readonly ?int $billNumber = null,
        public readonly ?int $directExpenseNumber = null,
        public readonly ?string $transactionDate = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?string $vendorName = null,
        public readonly ?string $memo = null,
        public readonly ?array $items = null,
        public readonly ?array $expenses = null,
        public readonly ?string $amount = null,
        public readonly ?string $usedAmount = null,
        public readonly ?string $remainingAmount = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created VendorCredit ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $date,
        int $vendorId,
        int $companyId,
        string $currencyIso4217Code,
        string $exchangeRate,
        ?array $customFields = null,
        ?Address $shipFromAddress = null,
        ?Address $shipToAddress = null,
        ?string $supplyDate = null,
        ?string $placeOfSupply = null,
        ?TaxRegistrationNumbers $taxRegistrationNumbers = null,
        ?TaxMetadata $taxMetadata = null,
        ?int $billNumber = null,
        ?int $directExpenseNumber = null,
        ?string $transactionDate = null,
        ?string $memo = null,
        ?array $items = null,
        ?array $expenses = null,
        ?RecordStatus $recordStatus = null,
    ): self {
        return new self(
            date: $date,
            vendorId: $vendorId,
            companyId: $companyId,
            currencyIso4217Code: $currencyIso4217Code,
            exchangeRate: $exchangeRate,
            customFields: $customFields,
            shipFromAddress: $shipFromAddress,
            shipToAddress: $shipToAddress,
            supplyDate: $supplyDate,
            placeOfSupply: $placeOfSupply,
            taxRegistrationNumbers: $taxRegistrationNumbers,
            taxMetadata: $taxMetadata,
            tax: null,
            classifications: null,
            transactionIds: null,
            createdBy: null,
            updatedBy: null,
            internalId: null,
            number: null,
            code: null,
            billNumber: $billNumber,
            directExpenseNumber: $directExpenseNumber,
            transactionDate: $transactionDate,
            companyName: null,
            companyCurrency: null,
            vendorName: null,
            memo: $memo,
            items: $items,
            expenses: $expenses,
            amount: null,
            usedAmount: null,
            remainingAmount: null,
            recordStatus: $recordStatus,
            createdAt: null,
            updatedAt: null,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            date: $data['date'],
            vendorId: $data['vendor_id'],
            companyId: $data['company_id'],
            currencyIso4217Code: $data['currency_iso_4217_code'],
            exchangeRate: $data['exchange_rate'],
            customFields: $data['custom_fields'] ?? null,
            shipFromAddress: isset($data['ship_from_address']) ? Address::fromWire($data['ship_from_address']) : null,
            shipToAddress: isset($data['ship_to_address']) ? Address::fromWire($data['ship_to_address']) : null,
            supplyDate: $data['supply_date'] ?? null,
            placeOfSupply: $data['place_of_supply'] ?? null,
            taxRegistrationNumbers: isset($data['tax_registration_numbers']) ? TaxRegistrationNumbers::fromWire($data['tax_registration_numbers']) : null,
            taxMetadata: isset($data['tax_metadata']) ? TaxMetadata::fromWire($data['tax_metadata']) : null,
            tax: $data['tax'] ?? null,
            classifications: array_map(static fn (array $row): RecordClassification => RecordClassification::fromWire($row), $data['classifications'] ?? []),
            transactionIds: $data['transaction_ids'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            internalId: $data['internal_id'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            billNumber: $data['bill_number'] ?? null,
            directExpenseNumber: $data['direct_expense_number'] ?? null,
            transactionDate: $data['transaction_date'] ?? null,
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            vendorName: $data['vendor_name'] ?? null,
            memo: $data['memo'] ?? null,
            items: $data['items'] ?? null,
            expenses: $data['expenses'] ?? null,
            amount: $data['amount'] ?? null,
            usedAmount: $data['used_amount'] ?? null,
            remainingAmount: $data['remaining_amount'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'date' => $this->date,
            'vendor_id' => $this->vendorId,
            'company_id' => $this->companyId,
            'currency_iso_4217_code' => $this->currencyIso4217Code,
            'exchange_rate' => $this->exchangeRate,
            'custom_fields' => $this->customFields,
            'ship_from_address' => $this->shipFromAddress?->toWire(),
            'ship_to_address' => $this->shipToAddress?->toWire(),
            'supply_date' => $this->supplyDate,
            'place_of_supply' => $this->placeOfSupply,
            'tax_registration_numbers' => $this->taxRegistrationNumbers?->toWire(),
            'tax_metadata' => $this->taxMetadata?->toWire(),
            'bill_number' => $this->billNumber,
            'direct_expense_number' => $this->directExpenseNumber,
            'transaction_date' => $this->transactionDate,
            'memo' => $this->memo,
            'items' => $this->items,
            'expenses' => $this->expenses,
            'record_status' => $this->recordStatus?->toWire(),
        ], static fn (mixed $value): bool => $value !== null);
    }
}
