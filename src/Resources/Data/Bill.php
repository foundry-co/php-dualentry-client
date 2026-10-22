<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Address;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;
use FoundryCo\DualEntry\ValueObjects\TaxMetadata;
use FoundryCo\DualEntry\ValueObjects\TaxRegistrationNumbers;

/**
 * @method $this withDate(string $date)
 * @method $this withCustomFields(?array $customFields)
 * @method $this withShipFromAddress(?Address $shipFromAddress)
 * @method $this withShipToAddress(?Address $shipToAddress)
 * @method $this withSupplyDate(?string $supplyDate)
 * @method $this withPlaceOfSupply(?string $placeOfSupply)
 * @method $this withTaxRegistrationNumbers(?TaxRegistrationNumbers $taxRegistrationNumbers)
 * @method $this withTaxMetadata(?TaxMetadata $taxMetadata)
 * @method $this withTax(?array $tax)
 * @method $this withTransactionIds(?array $transactionIds)
 * @method $this withTermId(?int $termId)
 * @method $this withTermName(?string $termName)
 * @method $this withBankMatchStatus(?string $bankMatchStatus)
 * @method $this withReconciliationStatus(?string $reconciliationStatus)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withApprovalStatus(?string $approvalStatus)
 * @method $this withNextApprovers(?array $nextApprovers)
 * @method $this withRejectedBy(?array $rejectedBy)
 * @method $this withInternalId(?int $internalId)
 * @method $this withNumber(?int $number)
 * @method $this withCode(?string $code)
 * @method $this withTransactionDate(?string $transactionDate)
 * @method $this withDueDate(?string $dueDate)
 * @method $this withCompanyId(?int $companyId)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCompanyCurrency(?string $companyCurrency)
 * @method $this withVendorId(?int $vendorId)
 * @method $this withVendorName(?string $vendorName)
 * @method $this withCurrencyIso4217Code(?SystemCurrencies $currencyIso4217Code)
 * @method $this withExchangeRate(?string $exchangeRate)
 * @method $this withMemo(?string $memo)
 * @method $this withAmount(?string $amount)
 * @method $this withAmountDue(?string $amountDue)
 * @method $this withPaidTotal(?string $paidTotal)
 * @method $this withItems(?array $items)
 * @method $this withExpenses(?array $expenses)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withRecurringRecordNumber(?int $recurringRecordNumber)
 * @method $this withPurchaseOrderNumber(?int $purchaseOrderNumber)
 * @method $this withReferenceNumber(?string $referenceNumber)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 */
final class Bill
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly string $date,
        public readonly ?array $customFields = null,
        public readonly ?Address $shipFromAddress = null,
        public readonly ?Address $shipToAddress = null,
        public readonly ?string $supplyDate = null,
        public readonly ?string $placeOfSupply = null,
        public readonly ?TaxRegistrationNumbers $taxRegistrationNumbers = null,
        public readonly ?TaxMetadata $taxMetadata = null,
        public readonly ?array $tax = null,
        public readonly ?array $transactionIds = null,
        public readonly ?int $termId = null,
        public readonly ?string $termName = null,
        public readonly ?string $bankMatchStatus = null,
        public readonly ?string $reconciliationStatus = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?string $approvalStatus = null,
        public readonly ?array $nextApprovers = null,
        public readonly ?array $rejectedBy = null,
        public readonly ?int $internalId = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        public readonly ?string $transactionDate = null,
        public readonly ?string $dueDate = null,
        public readonly ?int $companyId = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?int $vendorId = null,
        public readonly ?string $vendorName = null,
        public readonly ?SystemCurrencies $currencyIso4217Code = null,
        public readonly ?string $exchangeRate = null,
        public readonly ?string $memo = null,
        public readonly ?string $amount = null,
        public readonly ?string $amountDue = null,
        public readonly ?string $paidTotal = null,
        public readonly ?array $items = null,
        public readonly ?array $expenses = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?int $recurringRecordNumber = null,
        public readonly ?int $purchaseOrderNumber = null,
        public readonly ?string $referenceNumber = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created Bill ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $date,
        ?array $customFields = null,
        ?Address $shipFromAddress = null,
        ?Address $shipToAddress = null,
        ?string $supplyDate = null,
        ?string $placeOfSupply = null,
        ?TaxRegistrationNumbers $taxRegistrationNumbers = null,
        ?TaxMetadata $taxMetadata = null,
        ?int $termId = null,
        ?string $transactionDate = null,
        ?string $dueDate = null,
        ?int $companyId = null,
        ?int $vendorId = null,
        ?SystemCurrencies $currencyIso4217Code = null,
        ?string $exchangeRate = null,
        ?string $memo = null,
        ?array $items = null,
        ?array $expenses = null,
        ?RecordStatus $recordStatus = null,
        ?int $purchaseOrderNumber = null,
        ?string $referenceNumber = null,
    ): self {
        return new self(
            date: $date,
            customFields: $customFields,
            shipFromAddress: $shipFromAddress,
            shipToAddress: $shipToAddress,
            supplyDate: $supplyDate,
            placeOfSupply: $placeOfSupply,
            taxRegistrationNumbers: $taxRegistrationNumbers,
            taxMetadata: $taxMetadata,
            tax: null,
            transactionIds: null,
            termId: $termId,
            termName: null,
            bankMatchStatus: null,
            reconciliationStatus: null,
            createdBy: null,
            updatedBy: null,
            approvalStatus: null,
            nextApprovers: null,
            rejectedBy: null,
            internalId: null,
            number: null,
            code: null,
            transactionDate: $transactionDate,
            dueDate: $dueDate,
            companyId: $companyId,
            companyName: null,
            companyCurrency: null,
            vendorId: $vendorId,
            vendorName: null,
            currencyIso4217Code: $currencyIso4217Code,
            exchangeRate: $exchangeRate,
            memo: $memo,
            amount: null,
            amountDue: null,
            paidTotal: null,
            items: $items,
            expenses: $expenses,
            recordStatus: $recordStatus,
            recurringRecordNumber: null,
            purchaseOrderNumber: $purchaseOrderNumber,
            referenceNumber: $referenceNumber,
            createdAt: null,
            updatedAt: null,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            date: $data['date'],
            customFields: $data['custom_fields'] ?? null,
            shipFromAddress: isset($data['ship_from_address']) ? Address::fromWire($data['ship_from_address']) : null,
            shipToAddress: isset($data['ship_to_address']) ? Address::fromWire($data['ship_to_address']) : null,
            supplyDate: $data['supply_date'] ?? null,
            placeOfSupply: $data['place_of_supply'] ?? null,
            taxRegistrationNumbers: isset($data['tax_registration_numbers']) ? TaxRegistrationNumbers::fromWire($data['tax_registration_numbers']) : null,
            taxMetadata: isset($data['tax_metadata']) ? TaxMetadata::fromWire($data['tax_metadata']) : null,
            tax: $data['tax'] ?? null,
            transactionIds: $data['transaction_ids'] ?? null,
            termId: $data['term_id'] ?? null,
            termName: $data['term_name'] ?? null,
            bankMatchStatus: $data['bank_match_status'] ?? null,
            reconciliationStatus: $data['reconciliation_status'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            approvalStatus: $data['approval_status'] ?? null,
            nextApprovers: $data['next_approvers'] ?? null,
            rejectedBy: $data['rejected_by'] ?? null,
            internalId: $data['internal_id'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            transactionDate: $data['transaction_date'] ?? null,
            dueDate: $data['due_date'] ?? null,
            companyId: $data['company_id'] ?? null,
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            vendorId: $data['vendor_id'] ?? null,
            vendorName: $data['vendor_name'] ?? null,
            currencyIso4217Code: isset($data['currency_iso_4217_code']) ? SystemCurrencies::fromWire($data['currency_iso_4217_code']) : null,
            exchangeRate: $data['exchange_rate'] ?? null,
            memo: $data['memo'] ?? null,
            amount: $data['amount'] ?? null,
            amountDue: $data['amount_due'] ?? null,
            paidTotal: $data['paid_total'] ?? null,
            items: $data['items'] ?? null,
            expenses: $data['expenses'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            recurringRecordNumber: $data['recurring_record_number'] ?? null,
            purchaseOrderNumber: $data['purchase_order_number'] ?? null,
            referenceNumber: $data['reference_number'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'date' => $this->date,
            'custom_fields' => $this->customFields,
            'ship_from_address' => $this->shipFromAddress?->toWire(),
            'ship_to_address' => $this->shipToAddress?->toWire(),
            'supply_date' => $this->supplyDate,
            'place_of_supply' => $this->placeOfSupply,
            'tax_registration_numbers' => $this->taxRegistrationNumbers?->toWire(),
            'tax_metadata' => $this->taxMetadata?->toWire(),
            'term_id' => $this->termId,
            'transaction_date' => $this->transactionDate,
            'due_date' => $this->dueDate,
            'company_id' => $this->companyId,
            'vendor_id' => $this->vendorId,
            'currency_iso_4217_code' => $this->currencyIso4217Code?->toWire(),
            'exchange_rate' => $this->exchangeRate,
            'memo' => $this->memo,
            'items' => $this->items,
            'expenses' => $this->expenses,
            'record_status' => $this->recordStatus?->toWire(),
            'purchase_order_number' => $this->purchaseOrderNumber,
            'reference_number' => $this->referenceNumber,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
