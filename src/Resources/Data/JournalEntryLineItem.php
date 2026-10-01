<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;
use FoundryCo\DualEntry\ValueObjects\RecordClassification;

/**
 * @method $this withAccountNumber(int $accountNumber)
 * @method $this withDebit(string $debit)
 * @method $this withCredit(string $credit)
 * @method $this withPosition(int $position)
 * @method $this withMemo(string $memo)
 * @method $this withAmortizableAssets(?array $amortizableAssets)
 * @method $this withFixedAssets(?array $fixedAssets)
 * @method $this withClassifications(?array $classifications)
 * @method $this withIsBillable(?bool $isBillable)
 * @method $this withBillableCustomerId(?int $billableCustomerId)
 * @method $this withBillableCustomerName(?string $billableCustomerName)
 * @method $this withBillableProjectId(?int $billableProjectId)
 * @method $this withBillableProjectName(?string $billableProjectName)
 * @method $this withBillableMarkupPct(?string $billableMarkupPct)
 * @method $this withId(?int $id)
 * @method $this withEntryId(?int $entryId)
 * @method $this withCustomerId(?int $customerId)
 * @method $this withCustomerName(?string $customerName)
 * @method $this withVendorId(?int $vendorId)
 * @method $this withVendorName(?string $vendorName)
 * @method $this withReversalLineId(?int $reversalLineId)
 * @method $this withReversalEntryId(?int $reversalEntryId)
 * @method $this withCurrency(?SystemCurrencies $currency)
 */
final class JournalEntryLineItem
{
    use ImmutableAttributes;

    public function __construct(
        public readonly int $accountNumber,
        public readonly string $debit,
        public readonly string $credit,
        public readonly int $position,
        public readonly string $memo,
        public readonly ?array $amortizableAssets = null,
        public readonly ?array $fixedAssets = null,
        /** @var array<int, RecordClassification> */
        public readonly ?array $classifications = null,
        public readonly ?bool $isBillable = null,
        public readonly ?int $billableCustomerId = null,
        public readonly ?string $billableCustomerName = null,
        public readonly ?int $billableProjectId = null,
        public readonly ?string $billableProjectName = null,
        public readonly ?string $billableMarkupPct = null,
        public readonly ?int $id = null,
        public readonly ?int $entryId = null,
        public readonly ?int $customerId = null,
        public readonly ?string $customerName = null,
        public readonly ?int $vendorId = null,
        public readonly ?string $vendorName = null,
        public readonly ?int $reversalLineId = null,
        public readonly ?int $reversalEntryId = null,
        public readonly ?SystemCurrencies $currency = null,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            accountNumber: $data['account_number'],
            debit: $data['debit'],
            credit: $data['credit'],
            position: $data['position'],
            memo: $data['memo'],
            amortizableAssets: $data['amortizable_assets'] ?? null,
            fixedAssets: $data['fixed_assets'] ?? null,
            classifications: array_map(static fn (array $row): RecordClassification => RecordClassification::fromWire($row), $data['classifications'] ?? []),
            isBillable: $data['is_billable'] ?? null,
            billableCustomerId: $data['billable_customer_id'] ?? null,
            billableCustomerName: $data['billable_customer_name'] ?? null,
            billableProjectId: $data['billable_project_id'] ?? null,
            billableProjectName: $data['billable_project_name'] ?? null,
            billableMarkupPct: $data['billable_markup_pct'] ?? null,
            id: $data['id'] ?? null,
            entryId: $data['entry_id'] ?? null,
            customerId: $data['customer_id'] ?? null,
            customerName: $data['customer_name'] ?? null,
            vendorId: $data['vendor_id'] ?? null,
            vendorName: $data['vendor_name'] ?? null,
            reversalLineId: $data['reversal_line_id'] ?? null,
            reversalEntryId: $data['reversal_entry_id'] ?? null,
            currency: isset($data['currency']) ? SystemCurrencies::fromWire($data['currency']) : null,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'account_number' => $this->accountNumber,
            'debit' => $this->debit,
            'credit' => $this->credit,
            'position' => $this->position,
            'memo' => $this->memo,
            'classifications' => array_map(static fn (RecordClassification $row): array => $row->toWire(), $this->classifications),
            'is_billable' => $this->isBillable,
            'billable_customer_id' => $this->billableCustomerId,
            'billable_project_id' => $this->billableProjectId,
            'billable_markup_pct' => $this->billableMarkupPct,
            'id' => $this->id,
            'customer_id' => $this->customerId,
            'vendor_id' => $this->vendorId,
            'currency' => $this->currency?->toWire(),
        ], static fn (mixed $value): bool => $value !== null);
    }
}
