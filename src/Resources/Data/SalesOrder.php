<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Address;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SalesOrderInvoicedStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;
use FoundryCo\DualEntry\ValueObjects\TaxMetadata;
use FoundryCo\DualEntry\ValueObjects\TaxRegistrationNumbers;

/**
 * @method $this withMemo(string $memo)
 * @method $this withDate(string $date)
 * @method $this withCompanyId(int $companyId)
 * @method $this withCustomerId(int $customerId)
 * @method $this withCurrencyIso4217Code(SystemCurrencies $currencyIso4217Code)
 * @method $this withExchangeRate(string $exchangeRate)
 * @method $this withItems(array $items)
 * @method $this withBillToAddress(?string $billToAddress)
 * @method $this withShipToAddress(?string $shipToAddress)
 * @method $this withBillingAddress(?Address $billingAddress)
 * @method $this withShippingAddress(?Address $shippingAddress)
 * @method $this withCustomFields(?array $customFields)
 * @method $this withInvoicedStatus(?SalesOrderInvoicedStatus $invoicedStatus)
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
 * @method $this withCustomerName(?string $customerName)
 * @method $this withAmount(?string $amount)
 * @method $this withInvoicedTotal(?string $invoicedTotal)
 * @method $this withDueTotal(?string $dueTotal)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withRecurringRecordNumber(?int $recurringRecordNumber)
 * @method $this withReferenceNumber(?string $referenceNumber)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withSupplyDate(?string $supplyDate)
 * @method $this withPlaceOfSupply(?string $placeOfSupply)
 * @method $this withTaxRegistrationNumbers(?TaxRegistrationNumbers $taxRegistrationNumbers)
 * @method $this withTaxMetadata(?TaxMetadata $taxMetadata)
 */
final class SalesOrder
{
    use ImmutableAttributes;

    private function __construct(
        public readonly string $memo,
        public readonly string $date,
        public readonly int $companyId,
        public readonly int $customerId,
        public readonly SystemCurrencies $currencyIso4217Code,
        public readonly string $exchangeRate,
        /** @var array<int, SalesOrderLineItem> */
        public readonly array $items,
        public readonly ?string $billToAddress = null,
        public readonly ?string $shipToAddress = null,
        public readonly ?Address $billingAddress = null,
        public readonly ?Address $shippingAddress = null,
        public readonly ?array $customFields = null,
        public readonly ?SalesOrderInvoicedStatus $invoicedStatus = null,
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
        public readonly ?string $customerName = null,
        public readonly ?string $amount = null,
        public readonly ?string $invoicedTotal = null,
        public readonly ?string $dueTotal = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?int $recurringRecordNumber = null,
        public readonly ?string $referenceNumber = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?string $supplyDate = null,
        public readonly ?string $placeOfSupply = null,
        public readonly ?TaxRegistrationNumbers $taxRegistrationNumbers = null,
        public readonly ?TaxMetadata $taxMetadata = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created SalesOrder ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $memo,
        string $date,
        int $companyId,
        int $customerId,
        SystemCurrencies $currencyIso4217Code,
        string $exchangeRate,
        /** @var array<int, SalesOrderLineItem> */
        array $items,
        ?string $billToAddress = null,
        ?string $shipToAddress = null,
        ?Address $billingAddress = null,
        ?Address $shippingAddress = null,
        ?array $customFields = null,
        ?int $termId = null,
        ?RecordStatus $recordStatus = null,
        ?string $referenceNumber = null,
        ?string $supplyDate = null,
        ?string $placeOfSupply = null,
        ?TaxRegistrationNumbers $taxRegistrationNumbers = null,
        ?TaxMetadata $taxMetadata = null,
    ): self {
        return new self(
            memo: $memo,
            date: $date,
            companyId: $companyId,
            customerId: $customerId,
            currencyIso4217Code: $currencyIso4217Code,
            exchangeRate: $exchangeRate,
            items: $items,
            billToAddress: $billToAddress,
            shipToAddress: $shipToAddress,
            billingAddress: $billingAddress,
            shippingAddress: $shippingAddress,
            customFields: $customFields,
            invoicedStatus: null,
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
            customerName: null,
            amount: null,
            invoicedTotal: null,
            dueTotal: null,
            recordStatus: $recordStatus,
            recurringRecordNumber: null,
            referenceNumber: $referenceNumber,
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
            memo: $data['memo'],
            date: $data['date'],
            companyId: $data['company_id'],
            customerId: $data['customer_id'],
            currencyIso4217Code: SystemCurrencies::fromWire($data['currency_iso_4217_code']),
            exchangeRate: $data['exchange_rate'],
            items: array_map(static fn (array $row): SalesOrderLineItem => SalesOrderLineItem::fromWire($row), $data['items'] ?? []),
            billToAddress: $data['bill_to_address'] ?? null,
            shipToAddress: $data['ship_to_address'] ?? null,
            billingAddress: isset($data['billing_address']) ? Address::fromWire($data['billing_address']) : null,
            shippingAddress: isset($data['shipping_address']) ? Address::fromWire($data['shipping_address']) : null,
            customFields: $data['custom_fields'] ?? null,
            invoicedStatus: isset($data['invoiced_status']) ? SalesOrderInvoicedStatus::fromWire($data['invoiced_status']) : null,
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
            customerName: $data['customer_name'] ?? null,
            amount: $data['amount'] ?? null,
            invoicedTotal: $data['invoiced_total'] ?? null,
            dueTotal: $data['due_total'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            recurringRecordNumber: $data['recurring_record_number'] ?? null,
            referenceNumber: $data['reference_number'] ?? null,
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
            'memo' => $this->memo,
            'date' => $this->date,
            'company_id' => $this->companyId,
            'customer_id' => $this->customerId,
            'currency_iso_4217_code' => $this->currencyIso4217Code->toWire(),
            'exchange_rate' => $this->exchangeRate,
            'items' => array_map(static fn (SalesOrderLineItem $row): array => $row->toWire(), $this->items),
            'bill_to_address' => $this->billToAddress,
            'ship_to_address' => $this->shipToAddress,
            'billing_address' => $this->billingAddress?->toWire(),
            'shipping_address' => $this->shippingAddress?->toWire(),
            'custom_fields' => $this->customFields,
            'term_id' => $this->termId,
            'record_status' => $this->recordStatus?->toWire(),
            'reference_number' => $this->referenceNumber,
            'supply_date' => $this->supplyDate,
            'place_of_supply' => $this->placeOfSupply,
            'tax_registration_numbers' => $this->taxRegistrationNumbers?->toWire(),
            'tax_metadata' => $this->taxMetadata?->toWire(),
        ], static fn (mixed $value): bool => $value !== null);
    }
}
