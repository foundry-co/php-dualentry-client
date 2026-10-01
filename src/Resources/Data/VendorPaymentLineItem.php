<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;

/**
 * @method $this withAmount(string $amount)
 * @method $this withPosition(int $position)
 * @method $this withBillNumber(?int $billNumber)
 * @method $this withVendorCreditNumber(?int $vendorCreditNumber)
 * @method $this withJournalEntryLineId(?int $journalEntryLineId)
 * @method $this withIntercompanyJournalEntryLineId(?int $intercompanyJournalEntryLineId)
 * @method $this withBankOrCreditCardAmount(?string $bankOrCreditCardAmount)
 * @method $this withId(?int $id)
 */
final class VendorPaymentLineItem
{
    use ImmutableAttributes;

    public function __construct(
        public readonly string $amount,
        public readonly int $position,
        public readonly ?int $billNumber = null,
        public readonly ?int $vendorCreditNumber = null,
        public readonly ?int $journalEntryLineId = null,
        public readonly ?int $intercompanyJournalEntryLineId = null,
        public readonly ?string $bankOrCreditCardAmount = null,
        public readonly ?int $id = null,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            amount: $data['amount'],
            position: $data['position'],
            billNumber: $data['bill_number'] ?? null,
            vendorCreditNumber: $data['vendor_credit_number'] ?? null,
            journalEntryLineId: $data['journal_entry_line_id'] ?? null,
            intercompanyJournalEntryLineId: $data['intercompany_journal_entry_line_id'] ?? null,
            bankOrCreditCardAmount: $data['bank_or_credit_card_amount'] ?? null,
            id: $data['id'] ?? null,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'amount' => $this->amount,
            'position' => $this->position,
            'bill_number' => $this->billNumber,
            'vendor_credit_number' => $this->vendorCreditNumber,
            'journal_entry_line_id' => $this->journalEntryLineId,
            'intercompany_journal_entry_line_id' => $this->intercompanyJournalEntryLineId,
            'id' => $this->id,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
