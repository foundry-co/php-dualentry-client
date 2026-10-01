<?php

namespace FoundryCo\DualEntry\Resources\Data;

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
 * @method $this withVendorId(int $vendorId)
 * @method $this withAccountNumber(int $accountNumber)
 * @method $this withCurrencyIso4217Code(SystemCurrencies $currencyIso4217Code)
 * @method $this withBankOrCreditCardAmount(string $bankOrCreditCardAmount)
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
 * @method $this withVendorName(?string $vendorName)
 * @method $this withAmount(?string $amount)
 * @method $this withMemo(?string $memo)
 * @method $this withCheckNumber(?string $checkNumber)
 * @method $this withTransactionDate(?string $transactionDate)
 * @method $this withExchangeRate(?string $exchangeRate)
 * @method $this withPaymentMethodId(?int $paymentMethodId)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 */
final class DirectExpense
{
    use ImmutableAttributes;

    private function __construct(
        public readonly string $date,
        public readonly int $companyId,
        public readonly int $vendorId,
        public readonly int $accountNumber,
        public readonly SystemCurrencies $currencyIso4217Code,
        public readonly string $bankOrCreditCardAmount,
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
        public readonly ?string $bankMatchStatus = null,
        public readonly ?string $reconciliationStatus = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?int $internalId = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        /** @var array<int, DirectExpenseLineItem> */
        public readonly ?array $items = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?string $vendorName = null,
        public readonly ?string $amount = null,
        public readonly ?string $memo = null,
        public readonly ?string $checkNumber = null,
        public readonly ?string $transactionDate = null,
        public readonly ?string $exchangeRate = null,
        public readonly ?int $paymentMethodId = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created DirectExpense ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $date,
        int $companyId,
        int $vendorId,
        int $accountNumber,
        SystemCurrencies $currencyIso4217Code,
        string $bankOrCreditCardAmount,
        ?array $customFields = null,
        ?Address $shipFromAddress = null,
        ?Address $shipToAddress = null,
        ?string $supplyDate = null,
        ?string $placeOfSupply = null,
        ?TaxRegistrationNumbers $taxRegistrationNumbers = null,
        ?TaxMetadata $taxMetadata = null,
        /** @var array<int, DirectExpenseLineItem> */
        ?array $items = null,
        ?string $memo = null,
        ?string $checkNumber = null,
        ?string $transactionDate = null,
        ?string $exchangeRate = null,
        ?int $paymentMethodId = null,
        ?RecordStatus $recordStatus = null,
    ): self {
        return new self(
            date: $date,
            companyId: $companyId,
            vendorId: $vendorId,
            accountNumber: $accountNumber,
            currencyIso4217Code: $currencyIso4217Code,
            bankOrCreditCardAmount: $bankOrCreditCardAmount,
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
            vendorName: null,
            amount: null,
            memo: $memo,
            checkNumber: $checkNumber,
            transactionDate: $transactionDate,
            exchangeRate: $exchangeRate,
            paymentMethodId: $paymentMethodId,
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
            companyId: $data['company_id'],
            vendorId: $data['vendor_id'],
            accountNumber: $data['account_number'],
            currencyIso4217Code: SystemCurrencies::fromWire($data['currency_iso_4217_code']),
            bankOrCreditCardAmount: $data['bank_or_credit_card_amount'],
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
            bankMatchStatus: $data['bank_match_status'] ?? null,
            reconciliationStatus: $data['reconciliation_status'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            internalId: $data['internal_id'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            items: array_map(static fn (array $row): DirectExpenseLineItem => DirectExpenseLineItem::fromWire($row), $data['items'] ?? []),
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            vendorName: $data['vendor_name'] ?? null,
            amount: $data['amount'] ?? null,
            memo: $data['memo'] ?? null,
            checkNumber: $data['check_number'] ?? null,
            transactionDate: $data['transaction_date'] ?? null,
            exchangeRate: $data['exchange_rate'] ?? null,
            paymentMethodId: $data['payment_method_id'] ?? null,
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
            'company_id' => $this->companyId,
            'vendor_id' => $this->vendorId,
            'account_number' => $this->accountNumber,
            'currency_iso_4217_code' => $this->currencyIso4217Code->toWire(),
            'bank_or_credit_card_amount' => $this->bankOrCreditCardAmount,
            'custom_fields' => $this->customFields,
            'ship_from_address' => $this->shipFromAddress?->toWire(),
            'ship_to_address' => $this->shipToAddress?->toWire(),
            'supply_date' => $this->supplyDate,
            'place_of_supply' => $this->placeOfSupply,
            'tax_registration_numbers' => $this->taxRegistrationNumbers?->toWire(),
            'tax_metadata' => $this->taxMetadata?->toWire(),
            'items' => array_map(static fn (DirectExpenseLineItem $row): array => $row->toWire(), $this->items),
            'memo' => $this->memo,
            'check_number' => $this->checkNumber,
            'transaction_date' => $this->transactionDate,
            'exchange_rate' => $this->exchangeRate,
            'payment_method_id' => $this->paymentMethodId,
            'record_status' => $this->recordStatus?->toWire(),
        ], static fn (mixed $value): bool => $value !== null);
    }
}
