<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;

/**
 * @method $this withDate(string $date)
 * @method $this withCompanyId(int $companyId)
 * @method $this withCustomerId(int $customerId)
 * @method $this withCurrencyIso4217Code(SystemCurrencies $currencyIso4217Code)
 * @method $this withExchangeRate(string $exchangeRate)
 * @method $this withAmount(string $amount)
 * @method $this withBankOrUndepositedFundsAmount(string $bankOrUndepositedFundsAmount)
 * @method $this withTransactionIds(?array $transactionIds)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withCustomFields(?array $customFields)
 * @method $this withInternalId(?int $internalId)
 * @method $this withNumber(?int $number)
 * @method $this withCode(?string $code)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCompanyCurrency(?string $companyCurrency)
 * @method $this withCustomerName(?string $customerName)
 * @method $this withAccountNumber(?int $accountNumber)
 * @method $this withMemo(?string $memo)
 * @method $this withCheckNumber(?string $checkNumber)
 * @method $this withTransactionDate(?string $transactionDate)
 * @method $this withUndepositedFundsCurrency(?SystemCurrencies $undepositedFundsCurrency)
 * @method $this withUsedAmount(?string $usedAmount)
 * @method $this withRemainingAmount(?string $remainingAmount)
 * @method $this withPaymentMethodId(?int $paymentMethodId)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withCustomerDeposits(?array $customerDeposits)
 * @method $this withRecurringRecordNumber(?int $recurringRecordNumber)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 */
final class CustomerPrepayment
{
    use ImmutableAttributes;

    private function __construct(
        public readonly string $date,
        public readonly int $companyId,
        public readonly int $customerId,
        public readonly SystemCurrencies $currencyIso4217Code,
        public readonly string $exchangeRate,
        public readonly string $amount,
        public readonly string $bankOrUndepositedFundsAmount,
        public readonly ?array $transactionIds = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?array $customFields = null,
        public readonly ?int $internalId = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?string $customerName = null,
        public readonly ?int $accountNumber = null,
        public readonly ?string $memo = null,
        public readonly ?string $checkNumber = null,
        public readonly ?string $transactionDate = null,
        public readonly ?SystemCurrencies $undepositedFundsCurrency = null,
        public readonly ?string $usedAmount = null,
        public readonly ?string $remainingAmount = null,
        public readonly ?int $paymentMethodId = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?array $customerDeposits = null,
        public readonly ?int $recurringRecordNumber = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created CustomerPrepayment ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $date,
        int $companyId,
        int $customerId,
        SystemCurrencies $currencyIso4217Code,
        string $exchangeRate,
        string $amount,
        string $bankOrUndepositedFundsAmount,
        ?array $customFields = null,
        ?int $accountNumber = null,
        ?string $memo = null,
        ?string $checkNumber = null,
        ?string $transactionDate = null,
        ?SystemCurrencies $undepositedFundsCurrency = null,
        ?int $paymentMethodId = null,
        ?RecordStatus $recordStatus = null,
    ): self {
        return new self(
            date: $date,
            companyId: $companyId,
            customerId: $customerId,
            currencyIso4217Code: $currencyIso4217Code,
            exchangeRate: $exchangeRate,
            amount: $amount,
            bankOrUndepositedFundsAmount: $bankOrUndepositedFundsAmount,
            transactionIds: null,
            createdBy: null,
            updatedBy: null,
            customFields: $customFields,
            internalId: null,
            number: null,
            code: null,
            companyName: null,
            companyCurrency: null,
            customerName: null,
            accountNumber: $accountNumber,
            memo: $memo,
            checkNumber: $checkNumber,
            transactionDate: $transactionDate,
            undepositedFundsCurrency: $undepositedFundsCurrency,
            usedAmount: null,
            remainingAmount: null,
            paymentMethodId: $paymentMethodId,
            recordStatus: $recordStatus,
            customerDeposits: null,
            recurringRecordNumber: null,
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
            customerId: $data['customer_id'],
            currencyIso4217Code: SystemCurrencies::fromWire($data['currency_iso_4217_code']),
            exchangeRate: $data['exchange_rate'],
            amount: $data['amount'],
            bankOrUndepositedFundsAmount: $data['bank_or_undeposited_funds_amount'],
            transactionIds: $data['transaction_ids'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            customFields: $data['custom_fields'] ?? null,
            internalId: $data['internal_id'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            customerName: $data['customer_name'] ?? null,
            accountNumber: $data['account_number'] ?? null,
            memo: $data['memo'] ?? null,
            checkNumber: $data['check_number'] ?? null,
            transactionDate: $data['transaction_date'] ?? null,
            undepositedFundsCurrency: isset($data['undeposited_funds_currency']) ? SystemCurrencies::fromWire($data['undeposited_funds_currency']) : null,
            usedAmount: $data['used_amount'] ?? null,
            remainingAmount: $data['remaining_amount'] ?? null,
            paymentMethodId: $data['payment_method_id'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            customerDeposits: $data['customer_deposits'] ?? null,
            recurringRecordNumber: $data['recurring_record_number'] ?? null,
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
            'customer_id' => $this->customerId,
            'currency_iso_4217_code' => $this->currencyIso4217Code->toWire(),
            'exchange_rate' => $this->exchangeRate,
            'amount' => $this->amount,
            'bank_or_undeposited_funds_amount' => $this->bankOrUndepositedFundsAmount,
            'custom_fields' => $this->customFields,
            'account_number' => $this->accountNumber,
            'memo' => $this->memo,
            'check_number' => $this->checkNumber,
            'transaction_date' => $this->transactionDate,
            'undeposited_funds_currency' => $this->undepositedFundsCurrency?->toWire(),
            'payment_method_id' => $this->paymentMethodId,
            'record_status' => $this->recordStatus?->toWire(),
        ], static fn (mixed $value): bool => $value !== null);
    }
}
