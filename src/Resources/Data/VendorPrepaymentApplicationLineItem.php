<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;

/**
 * @method $this withBillNumber(int $billNumber)
 * @method $this withAmount(string $amount)
 * @method $this withPosition(int $position)
 * @method $this withAmountDue(?string $amountDue)
 * @method $this withId(?int $id)
 */
final class VendorPrepaymentApplicationLineItem
{
    use ImmutableAttributes;

    public function __construct(
        public readonly int $billNumber,
        public readonly string $amount,
        public readonly int $position,
        public readonly ?string $amountDue = null,
        public readonly ?int $id = null,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            billNumber: $data['bill_number'],
            amount: $data['amount'],
            position: $data['position'],
            amountDue: $data['amount_due'] ?? null,
            id: $data['id'] ?? null,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'bill_number' => $this->billNumber,
            'amount' => $this->amount,
            'position' => $this->position,
            'id' => $this->id,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
