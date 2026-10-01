<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\PaperCheckRecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\Source;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;
use FoundryCo\DualEntry\ValueObjects\RecordClassification;

/**
 * @method $this withDate(string $date)
 * @method $this withCompanyId(int $companyId)
 * @method $this withCheckNumber(string $checkNumber)
 * @method $this withAccountNumber(int $accountNumber)
 * @method $this withCurrencyIso4217Code(SystemCurrencies $currencyIso4217Code)
 * @method $this withExchangeRate(string $exchangeRate)
 * @method $this withMemo(string $memo)
 * @method $this withCustomFields(?array $customFields)
 * @method $this withIntegrationRemoteRecords(?array $integrationRemoteRecords)
 * @method $this withClassifications(?array $classifications)
 * @method $this withTransactionIds(?array $transactionIds)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withInternalId(?int $internalId)
 * @method $this withNumber(?int $number)
 * @method $this withCode(?string $code)
 * @method $this withItems(?array $items)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCompanyCurrency(?string $companyCurrency)
 * @method $this withVendorId(?int $vendorId)
 * @method $this withVendorName(?string $vendorName)
 * @method $this withTransactionDate(?string $transactionDate)
 * @method $this withBankOrCreditCardAmount(?string $bankOrCreditCardAmount)
 * @method $this withAmount(?string $amount)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withPaymentMethodId(?int $paymentMethodId)
 * @method $this withPaperCheckStatus(?PaperCheckRecordStatus $paperCheckStatus)
 * @method $this withSource(?Source $source)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withLineDateValidation(?bool $lineDateValidation)
 */
final class VendorPayment
{
    use ImmutableAttributes;

    private function __construct(
        public readonly string $date,
        public readonly int $companyId,
        public readonly string $checkNumber,
        public readonly int $accountNumber,
        public readonly SystemCurrencies $currencyIso4217Code,
        public readonly string $exchangeRate,
        public readonly string $memo,
        public readonly ?array $customFields = null,
        public readonly ?array $integrationRemoteRecords = null,
        /** @var array<int, RecordClassification> */
        public readonly ?array $classifications = null,
        public readonly ?array $transactionIds = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?int $internalId = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        /** @var array<int, VendorPaymentLineItem> */
        public readonly ?array $items = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?int $vendorId = null,
        public readonly ?string $vendorName = null,
        public readonly ?string $transactionDate = null,
        public readonly ?string $bankOrCreditCardAmount = null,
        public readonly ?string $amount = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?int $paymentMethodId = null,
        public readonly ?PaperCheckRecordStatus $paperCheckStatus = null,
        public readonly ?Source $source = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?bool $lineDateValidation = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created VendorPayment ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $date,
        int $companyId,
        string $checkNumber,
        int $accountNumber,
        SystemCurrencies $currencyIso4217Code,
        string $exchangeRate,
        string $memo,
        ?array $customFields = null,
        /** @var array<int, VendorPaymentLineItem> */
        ?array $items = null,
        ?string $transactionDate = null,
        ?string $bankOrCreditCardAmount = null,
        ?RecordStatus $recordStatus = null,
        ?int $paymentMethodId = null,
        ?bool $lineDateValidation = null,
    ): self {
        return new self(
            date: $date,
            companyId: $companyId,
            checkNumber: $checkNumber,
            accountNumber: $accountNumber,
            currencyIso4217Code: $currencyIso4217Code,
            exchangeRate: $exchangeRate,
            memo: $memo,
            customFields: $customFields,
            integrationRemoteRecords: null,
            classifications: null,
            transactionIds: null,
            createdBy: null,
            updatedBy: null,
            internalId: null,
            number: null,
            code: null,
            items: $items,
            companyName: null,
            companyCurrency: null,
            vendorId: null,
            vendorName: null,
            transactionDate: $transactionDate,
            bankOrCreditCardAmount: $bankOrCreditCardAmount,
            amount: null,
            recordStatus: $recordStatus,
            paymentMethodId: $paymentMethodId,
            paperCheckStatus: null,
            source: null,
            createdAt: null,
            updatedAt: null,
            lineDateValidation: $lineDateValidation,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            date: $data['date'],
            companyId: $data['company_id'],
            checkNumber: $data['check_number'],
            accountNumber: $data['account_number'],
            currencyIso4217Code: SystemCurrencies::fromWire($data['currency_iso_4217_code']),
            exchangeRate: $data['exchange_rate'],
            memo: $data['memo'],
            customFields: $data['custom_fields'] ?? null,
            integrationRemoteRecords: $data['integration_remote_records'] ?? null,
            classifications: array_map(static fn (array $row): RecordClassification => RecordClassification::fromWire($row), $data['classifications'] ?? []),
            transactionIds: $data['transaction_ids'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            internalId: $data['internal_id'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            items: array_map(static fn (array $row): VendorPaymentLineItem => VendorPaymentLineItem::fromWire($row), $data['items'] ?? []),
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            vendorId: $data['vendor_id'] ?? null,
            vendorName: $data['vendor_name'] ?? null,
            transactionDate: $data['transaction_date'] ?? null,
            bankOrCreditCardAmount: $data['bank_or_credit_card_amount'] ?? null,
            amount: $data['amount'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            paymentMethodId: $data['payment_method_id'] ?? null,
            paperCheckStatus: isset($data['paper_check_status']) ? PaperCheckRecordStatus::fromWire($data['paper_check_status']) : null,
            source: isset($data['source']) ? Source::fromWire($data['source']) : null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            lineDateValidation: $data['line_date_validation'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'date' => $this->date,
            'company_id' => $this->companyId,
            'check_number' => $this->checkNumber,
            'account_number' => $this->accountNumber,
            'currency_iso_4217_code' => $this->currencyIso4217Code->toWire(),
            'exchange_rate' => $this->exchangeRate,
            'memo' => $this->memo,
            'custom_fields' => $this->customFields,
            'items' => array_map(static fn (VendorPaymentLineItem $row): array => $row->toWire(), $this->items),
            'transaction_date' => $this->transactionDate,
            'bank_or_credit_card_amount' => $this->bankOrCreditCardAmount,
            'record_status' => $this->recordStatus?->toWire(),
            'payment_method_id' => $this->paymentMethodId,
            'line_date_validation' => $this->lineDateValidation,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
