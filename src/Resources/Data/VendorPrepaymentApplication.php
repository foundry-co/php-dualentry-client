<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;

/**
 * @method $this withDate(string $date)
 * @method $this withCompanyId(int $companyId)
 * @method $this withCurrencyIso4217Code(SystemCurrencies $currencyIso4217Code)
 * @method $this withExchangeRate(string $exchangeRate)
 * @method $this withMemo(string $memo)
 * @method $this withItems(array $items)
 * @method $this withInternalId(?int $internalId)
 * @method $this withTransactionIds(?array $transactionIds)
 * @method $this withNumber(?int $number)
 * @method $this withCode(?string $code)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCompanyCurrency(?string $companyCurrency)
 * @method $this withVendorId(?int $vendorId)
 * @method $this withVendorName(?string $vendorName)
 * @method $this withVendorPrepaymentNumber(?int $vendorPrepaymentNumber)
 * @method $this withVendorCreditNumber(?int $vendorCreditNumber)
 * @method $this withTransactionDate(?string $transactionDate)
 * @method $this withAmount(?string $amount)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 */
final class VendorPrepaymentApplication
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly string $date,
        public readonly int $companyId,
        public readonly SystemCurrencies $currencyIso4217Code,
        public readonly string $exchangeRate,
        public readonly string $memo,
        /** @var array<int, VendorPrepaymentApplicationLineItem> */
        public readonly array $items,
        public readonly ?int $internalId = null,
        public readonly ?array $transactionIds = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?int $vendorId = null,
        public readonly ?string $vendorName = null,
        public readonly ?int $vendorPrepaymentNumber = null,
        public readonly ?int $vendorCreditNumber = null,
        public readonly ?string $transactionDate = null,
        public readonly ?string $amount = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created VendorPrepaymentApplication ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $date,
        int $companyId,
        SystemCurrencies $currencyIso4217Code,
        string $exchangeRate,
        string $memo,
        /** @var array<int, VendorPrepaymentApplicationLineItem> */
        array $items,
        ?int $vendorPrepaymentNumber = null,
        ?int $vendorCreditNumber = null,
        ?string $transactionDate = null,
        ?RecordStatus $recordStatus = null,
    ): self {
        return new self(
            date: $date,
            companyId: $companyId,
            currencyIso4217Code: $currencyIso4217Code,
            exchangeRate: $exchangeRate,
            memo: $memo,
            items: $items,
            internalId: null,
            transactionIds: null,
            number: null,
            code: null,
            companyName: null,
            companyCurrency: null,
            vendorId: null,
            vendorName: null,
            vendorPrepaymentNumber: $vendorPrepaymentNumber,
            vendorCreditNumber: $vendorCreditNumber,
            transactionDate: $transactionDate,
            amount: null,
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
            currencyIso4217Code: SystemCurrencies::fromWire($data['currency_iso_4217_code']),
            exchangeRate: $data['exchange_rate'],
            memo: $data['memo'],
            items: array_map(static fn (array $row): VendorPrepaymentApplicationLineItem => VendorPrepaymentApplicationLineItem::fromWire($row), $data['items'] ?? []),
            internalId: $data['internal_id'] ?? null,
            transactionIds: $data['transaction_ids'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            vendorId: $data['vendor_id'] ?? null,
            vendorName: $data['vendor_name'] ?? null,
            vendorPrepaymentNumber: $data['vendor_prepayment_number'] ?? null,
            vendorCreditNumber: $data['vendor_credit_number'] ?? null,
            transactionDate: $data['transaction_date'] ?? null,
            amount: $data['amount'] ?? null,
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
            'currency_iso_4217_code' => $this->currencyIso4217Code->toWire(),
            'exchange_rate' => $this->exchangeRate,
            'memo' => $this->memo,
            'items' => array_map(static fn (VendorPrepaymentApplicationLineItem $row): array => $row->toWire(), $this->items),
            'vendor_prepayment_number' => $this->vendorPrepaymentNumber,
            'vendor_credit_number' => $this->vendorCreditNumber,
            'transaction_date' => $this->transactionDate,
            'record_status' => $this->recordStatus?->toWire(),
        ], static fn (mixed $value): bool => $value !== null);
    }
}
