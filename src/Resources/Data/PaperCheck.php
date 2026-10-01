<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\PaperCheckSourceRecordType;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;

/**
 * @method $this withId(?int $id)
 * @method $this withCode(?string $code)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withTransactionDate(?string $transactionDate)
 * @method $this withSourceRecordType(?PaperCheckSourceRecordType $sourceRecordType)
 * @method $this withSourceRecordId(?int $sourceRecordId)
 * @method $this withSourceRecordNumber(?int $sourceRecordNumber)
 * @method $this withCheckNumber(?string $checkNumber)
 * @method $this withCompanyId(?int $companyId)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withMemo(?string $memo)
 * @method $this withAmount(?string $amount)
 * @method $this withCurrencyIso4217Code(?SystemCurrencies $currencyIso4217Code)
 * @method $this withAccountNumber(?int $accountNumber)
 * @method $this withAccountName(?string $accountName)
 * @method $this withPayeeName(?string $payeeName)
 * @method $this withCustomerId(?int $customerId)
 * @method $this withCustomerName(?string $customerName)
 * @method $this withVendorId(?int $vendorId)
 * @method $this withVendorName(?string $vendorName)
 * @method $this withRecordStatus(?string $recordStatus)
 */
final class PaperCheck
{
    use ImmutableAttributes;

    private function __construct(
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $transactionDate = null,
        public readonly ?PaperCheckSourceRecordType $sourceRecordType = null,
        public readonly ?int $sourceRecordId = null,
        public readonly ?int $sourceRecordNumber = null,
        public readonly ?string $checkNumber = null,
        public readonly ?int $companyId = null,
        public readonly ?string $companyName = null,
        public readonly ?string $memo = null,
        public readonly ?string $amount = null,
        public readonly ?SystemCurrencies $currencyIso4217Code = null,
        public readonly ?int $accountNumber = null,
        public readonly ?string $accountName = null,
        public readonly ?string $payeeName = null,
        public readonly ?int $customerId = null,
        public readonly ?string $customerName = null,
        public readonly ?int $vendorId = null,
        public readonly ?string $vendorName = null,
        public readonly ?string $recordStatus = null,
        public readonly bool $exists = false,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            code: $data['code'] ?? null,
            createdAt: $data['created_at'] ?? null,
            transactionDate: $data['transaction_date'] ?? null,
            sourceRecordType: isset($data['source_record_type']) ? PaperCheckSourceRecordType::fromWire($data['source_record_type']) : null,
            sourceRecordId: $data['source_record_id'] ?? null,
            sourceRecordNumber: $data['source_record_number'] ?? null,
            checkNumber: $data['check_number'] ?? null,
            companyId: $data['company_id'] ?? null,
            companyName: $data['company_name'] ?? null,
            memo: $data['memo'] ?? null,
            amount: $data['amount'] ?? null,
            currencyIso4217Code: isset($data['currency_iso_4217_code']) ? SystemCurrencies::fromWire($data['currency_iso_4217_code']) : null,
            accountNumber: $data['account_number'] ?? null,
            accountName: $data['account_name'] ?? null,
            payeeName: $data['payee_name'] ?? null,
            customerId: $data['customer_id'] ?? null,
            customerName: $data['customer_name'] ?? null,
            vendorId: $data['vendor_id'] ?? null,
            vendorName: $data['vendor_name'] ?? null,
            recordStatus: $data['record_status'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([

        ], static fn (mixed $value): bool => $value !== null);
    }
}
