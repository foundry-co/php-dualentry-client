<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;
use FoundryCo\DualEntry\ValueObjects\RecordClassification;

/**
 * @method $this withCompanyId(int $companyId)
 * @method $this withAccountNumber(int $accountNumber)
 * @method $this withDebit(string $debit)
 * @method $this withCredit(string $credit)
 * @method $this withMemo(string $memo)
 * @method $this withPosition(int $position)
 * @method $this withId(?int $id)
 * @method $this withClassifications(?array $classifications)
 * @method $this withCustomerId(?int $customerId)
 * @method $this withVendorId(?int $vendorId)
 * @method $this withCurrency(?SystemCurrencies $currency)
 * @method $this withEliminate(?bool $eliminate)
 * @method $this withExchangeRate(?string $exchangeRate)
 */
final class IntercompanyJournalEntryLineItem
{
    use ImmutableAttributes;

    public function __construct(
        public readonly int $companyId,
        public readonly int $accountNumber,
        public readonly string $debit,
        public readonly string $credit,
        public readonly string $memo,
        public readonly int $position,
        public readonly ?int $id = null,
        /** @var array<int, RecordClassification> */
        public readonly ?array $classifications = null,
        public readonly ?int $customerId = null,
        public readonly ?int $vendorId = null,
        public readonly ?SystemCurrencies $currency = null,
        public readonly ?bool $eliminate = null,
        public readonly ?string $exchangeRate = null,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            companyId: $data['company_id'],
            accountNumber: $data['account_number'],
            debit: $data['debit'],
            credit: $data['credit'],
            memo: $data['memo'],
            position: $data['position'],
            id: $data['id'] ?? null,
            classifications: array_map(static fn (array $row): RecordClassification => RecordClassification::fromWire($row), $data['classifications'] ?? []),
            customerId: $data['customer_id'] ?? null,
            vendorId: $data['vendor_id'] ?? null,
            currency: isset($data['currency']) ? SystemCurrencies::fromWire($data['currency']) : null,
            eliminate: $data['eliminate'] ?? null,
            exchangeRate: $data['exchange_rate'] ?? null,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'company_id' => $this->companyId,
            'account_number' => $this->accountNumber,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'memo' => $this->memo,
            'position' => $this->position,
            'id' => $this->id,
            'classifications' => array_map(static fn (RecordClassification $row): array => $row->toWire(), $this->classifications),
            'customer_id' => $this->customerId,
            'vendor_id' => $this->vendorId,
            'currency' => $this->currency?->toWire(),
            'eliminate' => $this->eliminate,
            'exchange_rate' => $this->exchangeRate,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
