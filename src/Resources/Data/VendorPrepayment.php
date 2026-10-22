<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\PaperCheckRecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;

/**
 * @method $this withDate(string $date)
 * @method $this withCompanyId(int $companyId)
 * @method $this withVendorId(int $vendorId)
 * @method $this withCheckNumber(string $checkNumber)
 * @method $this withAmount(string $amount)
 * @method $this withCurrencyIso4217Code(SystemCurrencies $currencyIso4217Code)
 * @method $this withExchangeRate(string $exchangeRate)
 * @method $this withBankOrUndepositedFundsAmount(string $bankOrUndepositedFundsAmount)
 * @method $this withMemo(string $memo)
 * @method $this withCustomFields(?array $customFields)
 * @method $this withBankMatchStatus(?string $bankMatchStatus)
 * @method $this withReconciliationStatus(?string $reconciliationStatus)
 * @method $this withInternalId(?int $internalId)
 * @method $this withTransactionIds(?array $transactionIds)
 * @method $this withNumber(?int $number)
 * @method $this withCode(?string $code)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCompanyCurrency(?string $companyCurrency)
 * @method $this withVendorName(?string $vendorName)
 * @method $this withAccountNumber(?int $accountNumber)
 * @method $this withTransactionDate(?string $transactionDate)
 * @method $this withUsedAmount(?string $usedAmount)
 * @method $this withRemainingAmount(?string $remainingAmount)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withPaymentMethodId(?int $paymentMethodId)
 * @method $this withPaperCheckStatus(?PaperCheckRecordStatus $paperCheckStatus)
 * @method $this withRecurringRecordId(?int $recurringRecordId)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withFinancialTransactionToValidateMatch(?int $financialTransactionToValidateMatch)
 */
final class VendorPrepayment
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly string $date,
        public readonly int $companyId,
        public readonly int $vendorId,
        public readonly string $checkNumber,
        public readonly string $amount,
        public readonly SystemCurrencies $currencyIso4217Code,
        public readonly string $exchangeRate,
        public readonly string $bankOrUndepositedFundsAmount,
        public readonly string $memo,
        public readonly ?array $customFields = null,
        public readonly ?string $bankMatchStatus = null,
        public readonly ?string $reconciliationStatus = null,
        public readonly ?int $internalId = null,
        public readonly ?array $transactionIds = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?string $vendorName = null,
        public readonly ?int $accountNumber = null,
        public readonly ?string $transactionDate = null,
        public readonly ?string $usedAmount = null,
        public readonly ?string $remainingAmount = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?int $paymentMethodId = null,
        public readonly ?PaperCheckRecordStatus $paperCheckStatus = null,
        public readonly ?int $recurringRecordId = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?int $financialTransactionToValidateMatch = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created VendorPrepayment ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $date,
        int $companyId,
        int $vendorId,
        string $checkNumber,
        string $amount,
        SystemCurrencies $currencyIso4217Code,
        string $exchangeRate,
        string $bankOrUndepositedFundsAmount,
        string $memo,
        ?array $customFields = null,
        ?int $accountNumber = null,
        ?string $transactionDate = null,
        ?RecordStatus $recordStatus = null,
        ?int $paymentMethodId = null,
        ?int $financialTransactionToValidateMatch = null,
    ): self {
        return new self(
            date: $date,
            companyId: $companyId,
            vendorId: $vendorId,
            checkNumber: $checkNumber,
            amount: $amount,
            currencyIso4217Code: $currencyIso4217Code,
            exchangeRate: $exchangeRate,
            bankOrUndepositedFundsAmount: $bankOrUndepositedFundsAmount,
            memo: $memo,
            customFields: $customFields,
            bankMatchStatus: null,
            reconciliationStatus: null,
            internalId: null,
            transactionIds: null,
            number: null,
            code: null,
            companyName: null,
            companyCurrency: null,
            vendorName: null,
            accountNumber: $accountNumber,
            transactionDate: $transactionDate,
            usedAmount: null,
            remainingAmount: null,
            recordStatus: $recordStatus,
            paymentMethodId: $paymentMethodId,
            paperCheckStatus: null,
            recurringRecordId: null,
            createdAt: null,
            updatedAt: null,
            financialTransactionToValidateMatch: $financialTransactionToValidateMatch,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            date: $data['date'],
            companyId: $data['company_id'],
            vendorId: $data['vendor_id'],
            checkNumber: $data['check_number'],
            amount: $data['amount'],
            currencyIso4217Code: SystemCurrencies::fromWire($data['currency_iso_4217_code']),
            exchangeRate: $data['exchange_rate'],
            bankOrUndepositedFundsAmount: $data['bank_or_undeposited_funds_amount'],
            memo: $data['memo'],
            customFields: $data['custom_fields'] ?? null,
            bankMatchStatus: $data['bank_match_status'] ?? null,
            reconciliationStatus: $data['reconciliation_status'] ?? null,
            internalId: $data['internal_id'] ?? null,
            transactionIds: $data['transaction_ids'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            vendorName: $data['vendor_name'] ?? null,
            accountNumber: $data['account_number'] ?? null,
            transactionDate: $data['transaction_date'] ?? null,
            usedAmount: $data['used_amount'] ?? null,
            remainingAmount: $data['remaining_amount'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            paymentMethodId: $data['payment_method_id'] ?? null,
            paperCheckStatus: isset($data['paper_check_status']) ? PaperCheckRecordStatus::fromWire($data['paper_check_status']) : null,
            recurringRecordId: $data['recurring_record_id'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            financialTransactionToValidateMatch: $data['financial_transaction_to_validate_match'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'date' => $this->date,
            'company_id' => $this->companyId,
            'vendor_id' => $this->vendorId,
            'check_number' => $this->checkNumber,
            'amount' => $this->amount,
            'currency_iso_4217_code' => $this->currencyIso4217Code->toWire(),
            'exchange_rate' => $this->exchangeRate,
            'bank_or_undeposited_funds_amount' => $this->bankOrUndepositedFundsAmount,
            'memo' => $this->memo,
            'custom_fields' => $this->customFields,
            'account_number' => $this->accountNumber,
            'transaction_date' => $this->transactionDate,
            'record_status' => $this->recordStatus?->toWire(),
            'payment_method_id' => $this->paymentMethodId,
            'financial_transaction_to_validate_match' => $this->financialTransactionToValidateMatch,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
