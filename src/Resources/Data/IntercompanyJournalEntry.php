<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;

/**
 * @method $this withDate(string $date)
 * @method $this withCurrencyIso4217Code(SystemCurrencies $currencyIso4217Code)
 * @method $this withExchangeRate(string $exchangeRate)
 * @method $this withItems(array $items)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withApprovalStatus(?string $approvalStatus)
 * @method $this withNextApprovers(?array $nextApprovers)
 * @method $this withRejectedBy(?array $rejectedBy)
 * @method $this withRecordNumber(?int $recordNumber)
 * @method $this withCode(?string $code)
 * @method $this withTransactionDate(?string $transactionDate)
 * @method $this withMemo(?string $memo)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withCompanies(?array $companies)
 * @method $this withCompanyIds(?array $companyIds)
 */
final class IntercompanyJournalEntry
{
    use ImmutableAttributes;

    private function __construct(
        public readonly string $date,
        public readonly SystemCurrencies $currencyIso4217Code,
        public readonly string $exchangeRate,
        public readonly array $items,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?string $approvalStatus = null,
        public readonly ?array $nextApprovers = null,
        public readonly ?array $rejectedBy = null,
        public readonly ?int $recordNumber = null,
        public readonly ?string $code = null,
        public readonly ?string $transactionDate = null,
        public readonly ?string $memo = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?array $companies = null,
        public readonly ?array $companyIds = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created IntercompanyJournalEntry ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $date,
        SystemCurrencies $currencyIso4217Code,
        string $exchangeRate,
        array $items,
        ?string $transactionDate = null,
        ?string $memo = null,
        ?RecordStatus $recordStatus = null,
    ): self {
        return new self(
            date: $date,
            currencyIso4217Code: $currencyIso4217Code,
            exchangeRate: $exchangeRate,
            items: $items,
            createdAt: null,
            updatedAt: null,
            approvalStatus: null,
            nextApprovers: null,
            rejectedBy: null,
            recordNumber: null,
            code: null,
            transactionDate: $transactionDate,
            memo: $memo,
            recordStatus: $recordStatus,
            companies: null,
            companyIds: null,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            date: $data['date'],
            currencyIso4217Code: SystemCurrencies::fromWire($data['currency_iso_4217_code']),
            exchangeRate: $data['exchange_rate'],
            items: $data['items'],
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            approvalStatus: $data['approval_status'] ?? null,
            nextApprovers: $data['next_approvers'] ?? null,
            rejectedBy: $data['rejected_by'] ?? null,
            recordNumber: $data['record_number'] ?? null,
            code: $data['code'] ?? null,
            transactionDate: $data['transaction_date'] ?? null,
            memo: $data['memo'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            companies: $data['companies'] ?? null,
            companyIds: $data['company_ids'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'date' => $this->date,
            'currency_iso_4217_code' => $this->currencyIso4217Code->toWire(),
            'exchange_rate' => $this->exchangeRate,
            'items' => $this->items,
            'transaction_date' => $this->transactionDate,
            'memo' => $this->memo,
            'record_status' => $this->recordStatus?->toWire(),
        ], static fn (mixed $value): bool => $value !== null);
    }
}
