<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;

/**
 * @method $this withDate(string $date)
 * @method $this withCustomFields(?array $customFields)
 * @method $this withReversalItems(?array $reversalItems)
 * @method $this withItems(?array $items)
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
 * @method $this withTransactionId(?int $transactionId)
 * @method $this withCompanyId(?int $companyId)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCompanyCurrency(?string $companyCurrency)
 * @method $this withMemo(?string $memo)
 * @method $this withTransactionDate(?string $transactionDate)
 * @method $this withCurrencyIso4217Code(?SystemCurrencies $currencyIso4217Code)
 * @method $this withAmount(?string $amount)
 * @method $this withExchangeRate(?string $exchangeRate)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withCreatedById(?int $createdById)
 * @method $this withCreatedByName(?string $createdByName)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withReversalDate(?string $reversalDate)
 */
final class JournalEntry
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly string $date,
        public readonly ?array $customFields = null,
        public readonly ?array $reversalItems = null,
        public readonly ?array $items = null,
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
        public readonly ?int $transactionId = null,
        public readonly ?int $companyId = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?string $memo = null,
        public readonly ?string $transactionDate = null,
        public readonly ?SystemCurrencies $currencyIso4217Code = null,
        public readonly ?string $amount = null,
        public readonly ?string $exchangeRate = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?int $createdById = null,
        public readonly ?string $createdByName = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?string $reversalDate = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created JournalEntry ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $date,
        ?array $customFields = null,
        ?array $items = null,
        ?int $companyId = null,
        ?string $memo = null,
        ?string $transactionDate = null,
        ?SystemCurrencies $currencyIso4217Code = null,
        ?string $exchangeRate = null,
        ?RecordStatus $recordStatus = null,
        ?string $reversalDate = null,
    ): self {
        return new self(
            date: $date,
            customFields: $customFields,
            reversalItems: null,
            items: $items,
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
            transactionId: null,
            companyId: $companyId,
            companyName: null,
            companyCurrency: null,
            memo: $memo,
            transactionDate: $transactionDate,
            currencyIso4217Code: $currencyIso4217Code,
            amount: null,
            exchangeRate: $exchangeRate,
            recordStatus: $recordStatus,
            createdById: null,
            createdByName: null,
            createdAt: null,
            updatedAt: null,
            reversalDate: $reversalDate,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            date: $data['date'],
            customFields: $data['custom_fields'] ?? null,
            reversalItems: $data['reversal_items'] ?? null,
            items: $data['items'] ?? null,
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
            transactionId: $data['transaction_id'] ?? null,
            companyId: $data['company_id'] ?? null,
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            memo: $data['memo'] ?? null,
            transactionDate: $data['transaction_date'] ?? null,
            currencyIso4217Code: isset($data['currency_iso_4217_code']) ? SystemCurrencies::fromWire($data['currency_iso_4217_code']) : null,
            amount: $data['amount'] ?? null,
            exchangeRate: $data['exchange_rate'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            createdById: $data['created_by_id'] ?? null,
            createdByName: $data['created_by_name'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            reversalDate: $data['reversal_date'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'date' => $this->date,
            'custom_fields' => $this->customFields,
            'items' => $this->items,
            'company_id' => $this->companyId,
            'memo' => $this->memo,
            'transaction_date' => $this->transactionDate,
            'currency_iso_4217_code' => $this->currencyIso4217Code?->toWire(),
            'exchange_rate' => $this->exchangeRate,
            'record_status' => $this->recordStatus?->toWire(),
            'reversal_date' => $this->reversalDate,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
