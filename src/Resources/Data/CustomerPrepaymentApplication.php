<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;
use FoundryCo\DualEntry\ValueObjects\RecordClassification;

/**
 * @method $this withDate(string $date)
 * @method $this withCompanyId(int $companyId)
 * @method $this withCurrencyIso4217Code(SystemCurrencies $currencyIso4217Code)
 * @method $this withExchangeRate(string $exchangeRate)
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
 * @method $this withCustomerId(?int $customerId)
 * @method $this withCustomerName(?string $customerName)
 * @method $this withCustomerPrepaymentNumber(?int $customerPrepaymentNumber)
 * @method $this withCustomerCreditNumber(?int $customerCreditNumber)
 * @method $this withMemo(?string $memo)
 * @method $this withTransactionDate(?string $transactionDate)
 * @method $this withAmount(?string $amount)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withCustomFields(?array $customFields)
 */
final class CustomerPrepaymentApplication
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly string $date,
        public readonly int $companyId,
        public readonly SystemCurrencies $currencyIso4217Code,
        public readonly string $exchangeRate,
        /** @var array<int, RecordClassification> */
        public readonly ?array $classifications = null,
        public readonly ?array $transactionIds = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?int $internalId = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        /** @var array<int, CustomerPrepaymentApplicationLineItem> */
        public readonly ?array $items = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?int $customerId = null,
        public readonly ?string $customerName = null,
        public readonly ?int $customerPrepaymentNumber = null,
        public readonly ?int $customerCreditNumber = null,
        public readonly ?string $memo = null,
        public readonly ?string $transactionDate = null,
        public readonly ?string $amount = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?array $customFields = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created CustomerPrepaymentApplication ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $date,
        int $companyId,
        SystemCurrencies $currencyIso4217Code,
        string $exchangeRate,
        /** @var array<int, CustomerPrepaymentApplicationLineItem> */
        ?array $items = null,
        ?int $customerPrepaymentNumber = null,
        ?int $customerCreditNumber = null,
        ?string $memo = null,
        ?string $transactionDate = null,
        ?RecordStatus $recordStatus = null,
        ?array $customFields = null,
    ): self {
        return new self(
            date: $date,
            companyId: $companyId,
            currencyIso4217Code: $currencyIso4217Code,
            exchangeRate: $exchangeRate,
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
            customerId: null,
            customerName: null,
            customerPrepaymentNumber: $customerPrepaymentNumber,
            customerCreditNumber: $customerCreditNumber,
            memo: $memo,
            transactionDate: $transactionDate,
            amount: null,
            recordStatus: $recordStatus,
            createdAt: null,
            updatedAt: null,
            customFields: $customFields,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            date: $data['date'],
            companyId: $data['company_id'],
            currencyIso4217Code: SystemCurrencies::fromWire($data['currency_iso_4217_code']),
            exchangeRate: $data['exchange_rate'],
            classifications: array_map(static fn (array $row): RecordClassification => RecordClassification::fromWire($row), $data['classifications'] ?? []),
            transactionIds: $data['transaction_ids'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            internalId: $data['internal_id'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            items: array_map(static fn (array $row): CustomerPrepaymentApplicationLineItem => CustomerPrepaymentApplicationLineItem::fromWire($row), $data['items'] ?? []),
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            customerId: $data['customer_id'] ?? null,
            customerName: $data['customer_name'] ?? null,
            customerPrepaymentNumber: $data['customer_prepayment_number'] ?? null,
            customerCreditNumber: $data['customer_credit_number'] ?? null,
            memo: $data['memo'] ?? null,
            transactionDate: $data['transaction_date'] ?? null,
            amount: $data['amount'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            customFields: $data['custom_fields'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'date' => $this->date,
            'company_id' => $this->companyId,
            'currency_iso_4217_code' => $this->currencyIso4217Code->toWire(),
            'exchange_rate' => $this->exchangeRate,
            'items' => array_map(static fn (CustomerPrepaymentApplicationLineItem $row): array => $row->toWire(), $this->items),
            'customer_prepayment_number' => $this->customerPrepaymentNumber,
            'customer_credit_number' => $this->customerCreditNumber,
            'memo' => $this->memo,
            'transaction_date' => $this->transactionDate,
            'record_status' => $this->recordStatus?->toWire(),
            'custom_fields' => $this->customFields,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
