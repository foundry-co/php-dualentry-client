<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\BaseCurrencyAnchor;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;

/**
 * @method $this withDate(string $date)
 * @method $this withCompanyId(int $companyId)
 * @method $this withDebitBankAccountNumber(int $debitBankAccountNumber)
 * @method $this withCreditBankAccountNumber(int $creditBankAccountNumber)
 * @method $this withAmount(string $amount)
 * @method $this withBankMatchStatus(?string $bankMatchStatus)
 * @method $this withReconciliationStatus(?string $reconciliationStatus)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withInternalId(?int $internalId)
 * @method $this withNumber(?int $number)
 * @method $this withCode(?string $code)
 * @method $this withTransactionId(?int $transactionId)
 * @method $this withDebitEntryId(?int $debitEntryId)
 * @method $this withCreditEntryId(?int $creditEntryId)
 * @method $this withTransactionDate(?string $transactionDate)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCompanyCurrency(?string $companyCurrency)
 * @method $this withExchangeRate(?string $exchangeRate)
 * @method $this withCalculateGainLoss(?bool $calculateGainLoss)
 * @method $this withBaseCurrencyAnchor(?BaseCurrencyAnchor $baseCurrencyAnchor)
 * @method $this withMemo(?string $memo)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withCurrencyIso4217Code(?array $currencyIso4217Code)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 */
final class BankTransfer
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly string $date,
        public readonly int $companyId,
        public readonly int $debitBankAccountNumber,
        public readonly int $creditBankAccountNumber,
        public readonly string $amount,
        public readonly ?string $bankMatchStatus = null,
        public readonly ?string $reconciliationStatus = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?int $internalId = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        public readonly ?int $transactionId = null,
        public readonly ?int $debitEntryId = null,
        public readonly ?int $creditEntryId = null,
        public readonly ?string $transactionDate = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?string $exchangeRate = null,
        public readonly ?bool $calculateGainLoss = null,
        public readonly ?BaseCurrencyAnchor $baseCurrencyAnchor = null,
        public readonly ?string $memo = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?array $currencyIso4217Code = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created BankTransfer ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $date,
        int $companyId,
        int $debitBankAccountNumber,
        int $creditBankAccountNumber,
        string $amount,
        ?string $transactionDate = null,
        ?string $exchangeRate = null,
        ?bool $calculateGainLoss = null,
        ?BaseCurrencyAnchor $baseCurrencyAnchor = null,
        ?string $memo = null,
        ?RecordStatus $recordStatus = null,
    ): self {
        return new self(
            date: $date,
            companyId: $companyId,
            debitBankAccountNumber: $debitBankAccountNumber,
            creditBankAccountNumber: $creditBankAccountNumber,
            amount: $amount,
            bankMatchStatus: null,
            reconciliationStatus: null,
            createdBy: null,
            updatedBy: null,
            internalId: null,
            number: null,
            code: null,
            transactionId: null,
            debitEntryId: null,
            creditEntryId: null,
            transactionDate: $transactionDate,
            companyName: null,
            companyCurrency: null,
            exchangeRate: $exchangeRate,
            calculateGainLoss: $calculateGainLoss,
            baseCurrencyAnchor: $baseCurrencyAnchor,
            memo: $memo,
            recordStatus: $recordStatus,
            currencyIso4217Code: null,
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
            debitBankAccountNumber: $data['debit_bank_account_number'],
            creditBankAccountNumber: $data['credit_bank_account_number'],
            amount: $data['amount'],
            bankMatchStatus: $data['bank_match_status'] ?? null,
            reconciliationStatus: $data['reconciliation_status'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            internalId: $data['internal_id'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            transactionId: $data['transaction_id'] ?? null,
            debitEntryId: $data['debit_entry_id'] ?? null,
            creditEntryId: $data['credit_entry_id'] ?? null,
            transactionDate: $data['transaction_date'] ?? null,
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            exchangeRate: $data['exchange_rate'] ?? null,
            calculateGainLoss: $data['calculate_gain_loss'] ?? null,
            baseCurrencyAnchor: isset($data['base_currency_anchor']) ? BaseCurrencyAnchor::fromWire($data['base_currency_anchor']) : null,
            memo: $data['memo'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            currencyIso4217Code: $data['currency_iso_4217_code'] ?? null,
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
            'debit_bank_account_number' => $this->debitBankAccountNumber,
            'credit_bank_account_number' => $this->creditBankAccountNumber,
            'amount' => $this->amount,
            'transaction_date' => $this->transactionDate,
            'exchange_rate' => $this->exchangeRate,
            'calculate_gain_loss' => $this->calculateGainLoss,
            'base_currency_anchor' => $this->baseCurrencyAnchor?->toWire(),
            'memo' => $this->memo,
            'record_status' => $this->recordStatus?->toWire(),
        ], static fn (mixed $value): bool => $value !== null);
    }
}
