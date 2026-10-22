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
 * @method $this withCompanyId(int $companyId)
 * @method $this withCurrencyIso4217Code(SystemCurrencies $currencyIso4217Code)
 * @method $this withExchangeRate(string $exchangeRate)
 * @method $this withBillToAddress(?string $billToAddress)
 * @method $this withShipToAddress(?string $shipToAddress)
 * @method $this withBillingAddress(?Address $billingAddress)
 * @method $this withShippingAddress(?Address $shippingAddress)
 * @method $this withCustomerId(?int $customerId)
 * @method $this withCustomerName(?string $customerName)
 * @method $this withTransactionIds(?array $transactionIds)
 * @method $this withCustomFields(?array $customFields)
 * @method $this withIntegrationRemoteRecords(?array $integrationRemoteRecords)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withInternalId(?int $internalId)
 * @method $this withNumber(?int $number)
 * @method $this withCode(?string $code)
 * @method $this withInvoiceNumber(?int $invoiceNumber)
 * @method $this withCashSaleNumber(?int $cashSaleNumber)
 * @method $this withTransactionDate(?string $transactionDate)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCompanyCurrency(?string $companyCurrency)
 * @method $this withAmount(?string $amount)
 * @method $this withUsedAmount(?string $usedAmount)
 * @method $this withRemainingAmount(?string $remainingAmount)
 * @method $this withMemo(?string $memo)
 * @method $this withItems(?array $items)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withContractId(?int $contractId)
 * @method $this withContracted(?bool $contracted)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withSupplyDate(?string $supplyDate)
 * @method $this withPlaceOfSupply(?string $placeOfSupply)
 * @method $this withTaxRegistrationNumbers(?TaxRegistrationNumbers $taxRegistrationNumbers)
 * @method $this withTaxMetadata(?TaxMetadata $taxMetadata)
 */
final class CustomerCredit
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly string $date,
        public readonly int $companyId,
        public readonly SystemCurrencies $currencyIso4217Code,
        public readonly string $exchangeRate,
        public readonly ?string $billToAddress = null,
        public readonly ?string $shipToAddress = null,
        public readonly ?Address $billingAddress = null,
        public readonly ?Address $shippingAddress = null,
        public readonly ?int $customerId = null,
        public readonly ?string $customerName = null,
        public readonly ?array $transactionIds = null,
        public readonly ?array $customFields = null,
        public readonly ?array $integrationRemoteRecords = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?int $internalId = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        public readonly ?int $invoiceNumber = null,
        public readonly ?int $cashSaleNumber = null,
        public readonly ?string $transactionDate = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?string $amount = null,
        public readonly ?string $usedAmount = null,
        public readonly ?string $remainingAmount = null,
        public readonly ?string $memo = null,
        /** @var array<int, CustomerCreditLineItem> */
        public readonly ?array $items = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?int $contractId = null,
        public readonly ?bool $contracted = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?string $supplyDate = null,
        public readonly ?string $placeOfSupply = null,
        public readonly ?TaxRegistrationNumbers $taxRegistrationNumbers = null,
        public readonly ?TaxMetadata $taxMetadata = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created CustomerCredit ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $date,
        int $companyId,
        SystemCurrencies $currencyIso4217Code,
        string $exchangeRate,
        ?string $billToAddress = null,
        ?string $shipToAddress = null,
        ?Address $billingAddress = null,
        ?Address $shippingAddress = null,
        ?int $customerId = null,
        ?array $customFields = null,
        ?int $invoiceNumber = null,
        ?int $cashSaleNumber = null,
        ?string $transactionDate = null,
        ?string $memo = null,
        /** @var array<int, CustomerCreditLineItem> */
        ?array $items = null,
        ?RecordStatus $recordStatus = null,
        ?int $contractId = null,
        ?string $supplyDate = null,
        ?string $placeOfSupply = null,
        ?TaxRegistrationNumbers $taxRegistrationNumbers = null,
        ?TaxMetadata $taxMetadata = null,
    ): self {
        return new self(
            date: $date,
            companyId: $companyId,
            currencyIso4217Code: $currencyIso4217Code,
            exchangeRate: $exchangeRate,
            billToAddress: $billToAddress,
            shipToAddress: $shipToAddress,
            billingAddress: $billingAddress,
            shippingAddress: $shippingAddress,
            customerId: $customerId,
            customerName: null,
            transactionIds: null,
            customFields: $customFields,
            integrationRemoteRecords: null,
            createdBy: null,
            updatedBy: null,
            internalId: null,
            number: null,
            code: null,
            invoiceNumber: $invoiceNumber,
            cashSaleNumber: $cashSaleNumber,
            transactionDate: $transactionDate,
            companyName: null,
            companyCurrency: null,
            amount: null,
            usedAmount: null,
            remainingAmount: null,
            memo: $memo,
            items: $items,
            recordStatus: $recordStatus,
            contractId: $contractId,
            contracted: null,
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
            currencyIso4217Code: SystemCurrencies::fromWire($data['currency_iso_4217_code']),
            exchangeRate: $data['exchange_rate'],
            billToAddress: $data['bill_to_address'] ?? null,
            shipToAddress: $data['ship_to_address'] ?? null,
            billingAddress: isset($data['billing_address']) ? Address::fromWire($data['billing_address']) : null,
            shippingAddress: isset($data['shipping_address']) ? Address::fromWire($data['shipping_address']) : null,
            customerId: $data['customer_id'] ?? null,
            customerName: $data['customer_name'] ?? null,
            transactionIds: $data['transaction_ids'] ?? null,
            customFields: $data['custom_fields'] ?? null,
            integrationRemoteRecords: $data['integration_remote_records'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            internalId: $data['internal_id'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            invoiceNumber: $data['invoice_number'] ?? null,
            cashSaleNumber: $data['cash_sale_number'] ?? null,
            transactionDate: $data['transaction_date'] ?? null,
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            amount: $data['amount'] ?? null,
            usedAmount: $data['used_amount'] ?? null,
            remainingAmount: $data['remaining_amount'] ?? null,
            memo: $data['memo'] ?? null,
            items: array_map(static fn (array $row): CustomerCreditLineItem => CustomerCreditLineItem::fromWire($row), $data['items'] ?? []),
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            contractId: $data['contract_id'] ?? null,
            contracted: $data['contracted'] ?? null,
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
            'currency_iso_4217_code' => $this->currencyIso4217Code->toWire(),
            'exchange_rate' => $this->exchangeRate,
            'bill_to_address' => $this->billToAddress,
            'ship_to_address' => $this->shipToAddress,
            'billing_address' => $this->billingAddress?->toWire(),
            'shipping_address' => $this->shippingAddress?->toWire(),
            'customer_id' => $this->customerId,
            'custom_fields' => $this->customFields,
            'invoice_number' => $this->invoiceNumber,
            'cash_sale_number' => $this->cashSaleNumber,
            'transaction_date' => $this->transactionDate,
            'memo' => $this->memo,
            'items' => array_map(static fn (CustomerCreditLineItem $row): array => $row->toWire(), $this->items),
            'record_status' => $this->recordStatus?->toWire(),
            'contract_id' => $this->contractId,
            'supply_date' => $this->supplyDate,
            'place_of_supply' => $this->placeOfSupply,
            'tax_registration_numbers' => $this->taxRegistrationNumbers?->toWire(),
            'tax_metadata' => $this->taxMetadata?->toWire(),
        ], static fn (mixed $value): bool => $value !== null);
    }
}
