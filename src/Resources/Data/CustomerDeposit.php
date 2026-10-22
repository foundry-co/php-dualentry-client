<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;

/**
 * @method $this withDate(string $date)
 * @method $this withCompanyId(int $companyId)
 * @method $this withAccountNumber(int $accountNumber)
 * @method $this withCurrencyIso4217Code(SystemCurrencies $currencyIso4217Code)
 * @method $this withExchangeRate(string $exchangeRate)
 * @method $this withItems(array $items)
 * @method $this withCustomFields(?array $customFields)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withInternalId(?int $internalId)
 * @method $this withNumber(?int $number)
 * @method $this withCode(?string $code)
 * @method $this withTransactionId(?int $transactionId)
 * @method $this withTransactionDate(?string $transactionDate)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCompanyCurrency(?string $companyCurrency)
 * @method $this withAccountId(?int $accountId)
 * @method $this withAmount(?string $amount)
 * @method $this withMemo(?string $memo)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withCheckNumber(?string $checkNumber)
 */
final class CustomerDeposit
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly string $date,
        public readonly int $companyId,
        public readonly int $accountNumber,
        public readonly SystemCurrencies $currencyIso4217Code,
        public readonly string $exchangeRate,
        /** @var array<int, CustomerDepositLineItem> */
        public readonly array $items,
        public readonly ?array $customFields = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?int $internalId = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        public readonly ?int $transactionId = null,
        public readonly ?string $transactionDate = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?int $accountId = null,
        public readonly ?string $amount = null,
        public readonly ?string $memo = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?string $checkNumber = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created CustomerDeposit ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $date,
        int $companyId,
        int $accountNumber,
        SystemCurrencies $currencyIso4217Code,
        string $exchangeRate,
        /** @var array<int, CustomerDepositLineItem> */
        array $items,
        ?array $customFields = null,
        ?string $transactionDate = null,
        ?string $memo = null,
        ?RecordStatus $recordStatus = null,
        ?string $checkNumber = null,
    ): self {
        return new self(
            date: $date,
            companyId: $companyId,
            accountNumber: $accountNumber,
            currencyIso4217Code: $currencyIso4217Code,
            exchangeRate: $exchangeRate,
            items: $items,
            customFields: $customFields,
            createdBy: null,
            updatedBy: null,
            internalId: null,
            number: null,
            code: null,
            transactionId: null,
            transactionDate: $transactionDate,
            companyName: null,
            companyCurrency: null,
            accountId: null,
            amount: null,
            memo: $memo,
            recordStatus: $recordStatus,
            createdAt: null,
            updatedAt: null,
            checkNumber: $checkNumber,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            date: $data['date'],
            companyId: $data['company_id'],
            accountNumber: $data['account_number'],
            currencyIso4217Code: SystemCurrencies::fromWire($data['currency_iso_4217_code']),
            exchangeRate: $data['exchange_rate'],
            items: array_map(static fn (array $row): CustomerDepositLineItem => CustomerDepositLineItem::fromWire($row), $data['items'] ?? []),
            customFields: $data['custom_fields'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            internalId: $data['internal_id'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            transactionId: $data['transaction_id'] ?? null,
            transactionDate: $data['transaction_date'] ?? null,
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            accountId: $data['account_id'] ?? null,
            amount: $data['amount'] ?? null,
            memo: $data['memo'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            checkNumber: $data['check_number'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'date' => $this->date,
            'company_id' => $this->companyId,
            'account_number' => $this->accountNumber,
            'currency_iso_4217_code' => $this->currencyIso4217Code->toWire(),
            'exchange_rate' => $this->exchangeRate,
            'items' => array_map(static fn (CustomerDepositLineItem $row): array => $row->toWire(), $this->items),
            'custom_fields' => $this->customFields,
            'transaction_date' => $this->transactionDate,
            'memo' => $this->memo,
            'record_status' => $this->recordStatus?->toWire(),
            'check_number' => $this->checkNumber,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
