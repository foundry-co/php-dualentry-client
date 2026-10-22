<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Address;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;
use FoundryCo\DualEntry\ValueObjects\RecordClassification;
use FoundryCo\DualEntry\ValueObjects\TaxMetadata;
use FoundryCo\DualEntry\ValueObjects\TaxRegistrationNumbers;

/**
 * @method $this withDate(string $date)
 * @method $this withCompanyId(int $companyId)
 * @method $this withCustomerId(int $customerId)
 * @method $this withCurrencyIso4217Code(SystemCurrencies $currencyIso4217Code)
 * @method $this withExchangeRate(string $exchangeRate)
 * @method $this withBankOrUndepositedAccountAmount(string $bankOrUndepositedAccountAmount)
 * @method $this withBillToAddress(?string $billToAddress)
 * @method $this withShipToAddress(?string $shipToAddress)
 * @method $this withBillingAddress(?Address $billingAddress)
 * @method $this withShippingAddress(?Address $shippingAddress)
 * @method $this withCustomFields(?array $customFields)
 * @method $this withClassifications(?array $classifications)
 * @method $this withTransactionIds(?array $transactionIds)
 * @method $this withBankMatchStatus(?string $bankMatchStatus)
 * @method $this withReconciliationStatus(?string $reconciliationStatus)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withInternalId(?int $internalId)
 * @method $this withNumber(?int $number)
 * @method $this withCode(?string $code)
 * @method $this withItems(?array $items)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCompanyCurrency(?string $companyCurrency)
 * @method $this withCustomerName(?string $customerName)
 * @method $this withAccountNumber(?int $accountNumber)
 * @method $this withAmount(?string $amount)
 * @method $this withMemo(?string $memo)
 * @method $this withCheckNumber(?string $checkNumber)
 * @method $this withTransactionDate(?string $transactionDate)
 * @method $this withUndepositedFundsCurrency(?SystemCurrencies $undepositedFundsCurrency)
 * @method $this withPaymentMethodId(?int $paymentMethodId)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withSupplyDate(?string $supplyDate)
 * @method $this withPlaceOfSupply(?string $placeOfSupply)
 * @method $this withTaxRegistrationNumbers(?TaxRegistrationNumbers $taxRegistrationNumbers)
 * @method $this withTaxMetadata(?TaxMetadata $taxMetadata)
 */
final class CashSale
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly string $date,
        public readonly int $companyId,
        public readonly int $customerId,
        public readonly SystemCurrencies $currencyIso4217Code,
        public readonly string $exchangeRate,
        public readonly string $bankOrUndepositedAccountAmount,
        public readonly ?string $billToAddress = null,
        public readonly ?string $shipToAddress = null,
        public readonly ?Address $billingAddress = null,
        public readonly ?Address $shippingAddress = null,
        public readonly ?array $customFields = null,
        /** @var array<int, RecordClassification> */
        public readonly ?array $classifications = null,
        public readonly ?array $transactionIds = null,
        public readonly ?string $bankMatchStatus = null,
        public readonly ?string $reconciliationStatus = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?int $internalId = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        /** @var array<int, CashSaleLineItem> */
        public readonly ?array $items = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?string $customerName = null,
        public readonly ?int $accountNumber = null,
        public readonly ?string $amount = null,
        public readonly ?string $memo = null,
        public readonly ?string $checkNumber = null,
        public readonly ?string $transactionDate = null,
        public readonly ?SystemCurrencies $undepositedFundsCurrency = null,
        public readonly ?int $paymentMethodId = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?string $supplyDate = null,
        public readonly ?string $placeOfSupply = null,
        public readonly ?TaxRegistrationNumbers $taxRegistrationNumbers = null,
        public readonly ?TaxMetadata $taxMetadata = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created CashSale ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $date,
        int $companyId,
        int $customerId,
        SystemCurrencies $currencyIso4217Code,
        string $exchangeRate,
        string $bankOrUndepositedAccountAmount,
        ?string $billToAddress = null,
        ?string $shipToAddress = null,
        ?Address $billingAddress = null,
        ?Address $shippingAddress = null,
        ?array $customFields = null,
        /** @var array<int, CashSaleLineItem> */
        ?array $items = null,
        ?int $accountNumber = null,
        ?string $memo = null,
        ?string $checkNumber = null,
        ?string $transactionDate = null,
        ?SystemCurrencies $undepositedFundsCurrency = null,
        ?int $paymentMethodId = null,
        ?RecordStatus $recordStatus = null,
        ?string $supplyDate = null,
        ?string $placeOfSupply = null,
        ?TaxRegistrationNumbers $taxRegistrationNumbers = null,
        ?TaxMetadata $taxMetadata = null,
    ): self {
        return new self(
            date: $date,
            companyId: $companyId,
            customerId: $customerId,
            currencyIso4217Code: $currencyIso4217Code,
            exchangeRate: $exchangeRate,
            bankOrUndepositedAccountAmount: $bankOrUndepositedAccountAmount,
            billToAddress: $billToAddress,
            shipToAddress: $shipToAddress,
            billingAddress: $billingAddress,
            shippingAddress: $shippingAddress,
            customFields: $customFields,
            classifications: null,
            transactionIds: null,
            bankMatchStatus: null,
            reconciliationStatus: null,
            createdBy: null,
            updatedBy: null,
            internalId: null,
            number: null,
            code: null,
            items: $items,
            companyName: null,
            companyCurrency: null,
            customerName: null,
            accountNumber: $accountNumber,
            amount: null,
            memo: $memo,
            checkNumber: $checkNumber,
            transactionDate: $transactionDate,
            undepositedFundsCurrency: $undepositedFundsCurrency,
            paymentMethodId: $paymentMethodId,
            recordStatus: $recordStatus,
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
            customerId: $data['customer_id'],
            currencyIso4217Code: SystemCurrencies::fromWire($data['currency_iso_4217_code']),
            exchangeRate: $data['exchange_rate'],
            bankOrUndepositedAccountAmount: $data['bank_or_undeposited_account_amount'],
            billToAddress: $data['bill_to_address'] ?? null,
            shipToAddress: $data['ship_to_address'] ?? null,
            billingAddress: isset($data['billing_address']) ? Address::fromWire($data['billing_address']) : null,
            shippingAddress: isset($data['shipping_address']) ? Address::fromWire($data['shipping_address']) : null,
            customFields: $data['custom_fields'] ?? null,
            classifications: array_map(static fn (array $row): RecordClassification => RecordClassification::fromWire($row), $data['classifications'] ?? []),
            transactionIds: $data['transaction_ids'] ?? null,
            bankMatchStatus: $data['bank_match_status'] ?? null,
            reconciliationStatus: $data['reconciliation_status'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            internalId: $data['internal_id'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            items: array_map(static fn (array $row): CashSaleLineItem => CashSaleLineItem::fromWire($row), $data['items'] ?? []),
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            customerName: $data['customer_name'] ?? null,
            accountNumber: $data['account_number'] ?? null,
            amount: $data['amount'] ?? null,
            memo: $data['memo'] ?? null,
            checkNumber: $data['check_number'] ?? null,
            transactionDate: $data['transaction_date'] ?? null,
            undepositedFundsCurrency: isset($data['undeposited_funds_currency']) ? SystemCurrencies::fromWire($data['undeposited_funds_currency']) : null,
            paymentMethodId: $data['payment_method_id'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
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
            'customer_id' => $this->customerId,
            'currency_iso_4217_code' => $this->currencyIso4217Code->toWire(),
            'exchange_rate' => $this->exchangeRate,
            'bank_or_undeposited_account_amount' => $this->bankOrUndepositedAccountAmount,
            'bill_to_address' => $this->billToAddress,
            'ship_to_address' => $this->shipToAddress,
            'billing_address' => $this->billingAddress?->toWire(),
            'shipping_address' => $this->shippingAddress?->toWire(),
            'custom_fields' => $this->customFields,
            'items' => array_map(static fn (CashSaleLineItem $row): array => $row->toWire(), $this->items),
            'account_number' => $this->accountNumber,
            'memo' => $this->memo,
            'check_number' => $this->checkNumber,
            'transaction_date' => $this->transactionDate,
            'undeposited_funds_currency' => $this->undepositedFundsCurrency?->toWire(),
            'payment_method_id' => $this->paymentMethodId,
            'record_status' => $this->recordStatus?->toWire(),
            'supply_date' => $this->supplyDate,
            'place_of_supply' => $this->placeOfSupply,
            'tax_registration_numbers' => $this->taxRegistrationNumbers?->toWire(),
            'tax_metadata' => $this->taxMetadata?->toWire(),
        ], static fn (mixed $value): bool => $value !== null);
    }
}
