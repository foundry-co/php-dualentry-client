<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;

/**
 * @method $this withInvoiceNumber(int $invoiceNumber)
 * @method $this withAmount(string $amount)
 * @method $this withPosition(int $position)
 * @method $this withAmountDue(?string $amountDue)
 * @method $this withId(?int $id)
 */
final class CustomerPrepaymentApplicationLineItem
{
    use ImmutableAttributes;

    public function __construct(
        public readonly int $invoiceNumber,
        public readonly string $amount,
        public readonly int $position,
        public readonly ?string $amountDue = null,
        public readonly ?int $id = null,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            invoiceNumber: $data['invoice_number'],
            amount: $data['amount'],
            position: $data['position'],
            amountDue: $data['amount_due'] ?? null,
            id: $data['id'] ?? null,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'invoice_number' => $this->invoiceNumber,
            'amount' => $this->amount,
            'position' => $this->position,
            'id' => $this->id,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
