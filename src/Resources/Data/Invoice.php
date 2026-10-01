<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Address;
use FoundryCo\DualEntry\ValueObjects\Enums\DiscountType;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;
use FoundryCo\DualEntry\ValueObjects\TaxMetadata;
use FoundryCo\DualEntry\ValueObjects\TaxRegistrationNumbers;

/**
 * @method $this withDate(string $date)
 * @method $this withBillToAddress(?string $billToAddress)
 * @method $this withShipToAddress(?string $shipToAddress)
 * @method $this withBillingAddress(?Address $billingAddress)
 * @method $this withShippingAddress(?Address $shippingAddress)
 * @method $this withCustomFields(?array $customFields)
 * @method $this withSupplyDate(?string $supplyDate)
 * @method $this withPlaceOfSupply(?string $placeOfSupply)
 * @method $this withTaxRegistrationNumbers(?TaxRegistrationNumbers $taxRegistrationNumbers)
 * @method $this withTaxMetadata(?TaxMetadata $taxMetadata)
 * @method $this withTax(?array $tax)
 * @method $this withIntegrationRemoteRecords(?array $integrationRemoteRecords)
 * @method $this withCustomerName(?string $customerName)
 * @method $this withPayment(?array $payment)
 * @method $this withTermId(?int $termId)
 * @method $this withTermName(?string $termName)
 * @method $this withTransactionIds(?array $transactionIds)
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
 * @method $this withItems(?array $items)
 * @method $this withCompanyId(?int $companyId)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCompanyCurrency(?string $companyCurrency)
 * @method $this withCustomerId(?int $customerId)
 * @method $this withCurrencyIso4217Code(?SystemCurrencies $currencyIso4217Code)
 * @method $this withExchangeRate(?string $exchangeRate)
 * @method $this withSalesOrderNumber(?int $salesOrderNumber)
 * @method $this withAmount(?string $amount)
 * @method $this withAmountDue(?string $amountDue)
 * @method $this withPaidTotal(?string $paidTotal)
 * @method $this withAmountDueUpdatedAt(?string $amountDueUpdatedAt)
 * @method $this withMemo(?string $memo)
 * @method $this withTransactionDate(?string $transactionDate)
 * @method $this withDueDate(?string $dueDate)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withRecurringRecordNumber(?int $recurringRecordNumber)
 * @method $this withContracted(?bool $contracted)
 * @method $this withContractId(?int $contractId)
 * @method $this withArAccountId(?int $arAccountId)
 * @method $this withDiscountType(?DiscountType $discountType)
 * @method $this withDiscountValue(?string $discountValue)
 * @method $this withReferenceNumber(?string $referenceNumber)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withSalesOrderId(?int $salesOrderId)
 */
final class Invoice
{
    use ImmutableAttributes;

    private function __construct(
        public readonly string $date,
        public readonly ?string $billToAddress = null,
        public readonly ?string $shipToAddress = null,
        public readonly ?Address $billingAddress = null,
        public readonly ?Address $shippingAddress = null,
        public readonly ?array $customFields = null,
        public readonly ?string $supplyDate = null,
        public readonly ?string $placeOfSupply = null,
        public readonly ?TaxRegistrationNumbers $taxRegistrationNumbers = null,
        public readonly ?TaxMetadata $taxMetadata = null,
        public readonly ?array $tax = null,
        public readonly ?array $integrationRemoteRecords = null,
        public readonly ?string $customerName = null,
        public readonly ?array $payment = null,
        public readonly ?int $termId = null,
        public readonly ?string $termName = null,
        public readonly ?array $transactionIds = null,
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
        /** @var array<int, InvoiceLineItem> */
        public readonly ?array $items = null,
        public readonly ?int $companyId = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?int $customerId = null,
        public readonly ?SystemCurrencies $currencyIso4217Code = null,
        public readonly ?string $exchangeRate = null,
        public readonly ?int $salesOrderNumber = null,
        public readonly ?string $amount = null,
        public readonly ?string $amountDue = null,
        public readonly ?string $paidTotal = null,
        public readonly ?string $amountDueUpdatedAt = null,
        public readonly ?string $memo = null,
        public readonly ?string $transactionDate = null,
        public readonly ?string $dueDate = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?int $recurringRecordNumber = null,
        public readonly ?bool $contracted = null,
        public readonly ?int $contractId = null,
        public readonly ?int $arAccountId = null,
        public readonly ?DiscountType $discountType = null,
        public readonly ?string $discountValue = null,
        public readonly ?string $referenceNumber = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?int $salesOrderId = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created Invoice ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $date,
        ?string $billToAddress = null,
        ?string $shipToAddress = null,
        ?Address $billingAddress = null,
        ?Address $shippingAddress = null,
        ?array $customFields = null,
        ?string $supplyDate = null,
        ?string $placeOfSupply = null,
        ?TaxRegistrationNumbers $taxRegistrationNumbers = null,
        ?TaxMetadata $taxMetadata = null,
        ?array $payment = null,
        ?int $termId = null,
        /** @var array<int, InvoiceLineItem> */
        ?array $items = null,
        ?int $companyId = null,
        ?int $customerId = null,
        ?SystemCurrencies $currencyIso4217Code = null,
        ?string $exchangeRate = null,
        ?string $memo = null,
        ?string $transactionDate = null,
        ?string $dueDate = null,
        ?RecordStatus $recordStatus = null,
        ?bool $contracted = null,
        ?int $contractId = null,
        ?int $arAccountId = null,
        ?DiscountType $discountType = null,
        ?string $discountValue = null,
        ?string $referenceNumber = null,
        ?int $salesOrderId = null,
    ): self {
        return new self(
            date: $date,
            billToAddress: $billToAddress,
            shipToAddress: $shipToAddress,
            billingAddress: $billingAddress,
            shippingAddress: $shippingAddress,
            customFields: $customFields,
            supplyDate: $supplyDate,
            placeOfSupply: $placeOfSupply,
            taxRegistrationNumbers: $taxRegistrationNumbers,
            taxMetadata: $taxMetadata,
            tax: null,
            integrationRemoteRecords: null,
            customerName: null,
            payment: $payment,
            termId: $termId,
            termName: null,
            transactionIds: null,
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
            items: $items,
            companyId: $companyId,
            companyName: null,
            companyCurrency: null,
            customerId: $customerId,
            currencyIso4217Code: $currencyIso4217Code,
            exchangeRate: $exchangeRate,
            salesOrderNumber: null,
            amount: null,
            amountDue: null,
            paidTotal: null,
            amountDueUpdatedAt: null,
            memo: $memo,
            transactionDate: $transactionDate,
            dueDate: $dueDate,
            recordStatus: $recordStatus,
            recurringRecordNumber: null,
            contracted: $contracted,
            contractId: $contractId,
            arAccountId: $arAccountId,
            discountType: $discountType,
            discountValue: $discountValue,
            referenceNumber: $referenceNumber,
            createdAt: null,
            updatedAt: null,
            salesOrderId: $salesOrderId,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            date: $data['date'],
            billToAddress: $data['bill_to_address'] ?? null,
            shipToAddress: $data['ship_to_address'] ?? null,
            billingAddress: isset($data['billing_address']) ? Address::fromWire($data['billing_address']) : null,
            shippingAddress: isset($data['shipping_address']) ? Address::fromWire($data['shipping_address']) : null,
            customFields: $data['custom_fields'] ?? null,
            supplyDate: $data['supply_date'] ?? null,
            placeOfSupply: $data['place_of_supply'] ?? null,
            taxRegistrationNumbers: isset($data['tax_registration_numbers']) ? TaxRegistrationNumbers::fromWire($data['tax_registration_numbers']) : null,
            taxMetadata: isset($data['tax_metadata']) ? TaxMetadata::fromWire($data['tax_metadata']) : null,
            tax: $data['tax'] ?? null,
            integrationRemoteRecords: $data['integration_remote_records'] ?? null,
            customerName: $data['customer_name'] ?? null,
            payment: $data['payment'] ?? null,
            termId: $data['term_id'] ?? null,
            termName: $data['term_name'] ?? null,
            transactionIds: $data['transaction_ids'] ?? null,
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
            items: array_map(static fn (array $row): InvoiceLineItem => InvoiceLineItem::fromWire($row), $data['items'] ?? []),
            companyId: $data['company_id'] ?? null,
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            customerId: $data['customer_id'] ?? null,
            currencyIso4217Code: isset($data['currency_iso_4217_code']) ? SystemCurrencies::fromWire($data['currency_iso_4217_code']) : null,
            exchangeRate: $data['exchange_rate'] ?? null,
            salesOrderNumber: $data['sales_order_number'] ?? null,
            amount: $data['amount'] ?? null,
            amountDue: $data['amount_due'] ?? null,
            paidTotal: $data['paid_total'] ?? null,
            amountDueUpdatedAt: $data['amount_due_updated_at'] ?? null,
            memo: $data['memo'] ?? null,
            transactionDate: $data['transaction_date'] ?? null,
            dueDate: $data['due_date'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            recurringRecordNumber: $data['recurring_record_number'] ?? null,
            contracted: $data['contracted'] ?? null,
            contractId: $data['contract_id'] ?? null,
            arAccountId: $data['ar_account_id'] ?? null,
            discountType: isset($data['discount_type']) ? DiscountType::fromWire($data['discount_type']) : null,
            discountValue: $data['discount_value'] ?? null,
            referenceNumber: $data['reference_number'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            salesOrderId: $data['sales_order_id'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'date' => $this->date,
            'bill_to_address' => $this->billToAddress,
            'ship_to_address' => $this->shipToAddress,
            'billing_address' => $this->billingAddress?->toWire(),
            'shipping_address' => $this->shippingAddress?->toWire(),
            'custom_fields' => $this->customFields,
            'supply_date' => $this->supplyDate,
            'place_of_supply' => $this->placeOfSupply,
            'tax_registration_numbers' => $this->taxRegistrationNumbers?->toWire(),
            'tax_metadata' => $this->taxMetadata?->toWire(),
            'payment' => $this->payment,
            'term_id' => $this->termId,
            'items' => array_map(static fn (InvoiceLineItem $row): array => $row->toWire(), $this->items),
            'company_id' => $this->companyId,
            'customer_id' => $this->customerId,
            'currency_iso_4217_code' => $this->currencyIso4217Code?->toWire(),
            'exchange_rate' => $this->exchangeRate,
            'memo' => $this->memo,
            'transaction_date' => $this->transactionDate,
            'due_date' => $this->dueDate,
            'record_status' => $this->recordStatus?->toWire(),
            'contracted' => $this->contracted,
            'contract_id' => $this->contractId,
            'ar_account_id' => $this->arAccountId,
            'discount_type' => $this->discountType?->toWire(),
            'discount_value' => $this->discountValue,
            'reference_number' => $this->referenceNumber,
            'sales_order_id' => $this->salesOrderId,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
