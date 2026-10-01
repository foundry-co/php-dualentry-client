<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;

/**
 * @method $this withAmount(string $amount)
 * @method $this withPosition(int $position)
 * @method $this withVendorCreditNumber(?int $vendorCreditNumber)
 * @method $this withVendorPrepaymentNumber(?int $vendorPrepaymentNumber)
 * @method $this withBankOrCreditCardAmount(?string $bankOrCreditCardAmount)
 * @method $this withId(?int $id)
 */
final class VendorRefundLineItem
{
    use ImmutableAttributes;

    public function __construct(
        public readonly string $amount,
        public readonly int $position,
        public readonly ?int $vendorCreditNumber = null,
        public readonly ?int $vendorPrepaymentNumber = null,
        public readonly ?string $bankOrCreditCardAmount = null,
        public readonly ?int $id = null,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            amount: $data['amount'],
            position: $data['position'],
            vendorCreditNumber: $data['vendor_credit_number'] ?? null,
            vendorPrepaymentNumber: $data['vendor_prepayment_number'] ?? null,
            bankOrCreditCardAmount: $data['bank_or_credit_card_amount'] ?? null,
            id: $data['id'] ?? null,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'amount' => $this->amount,
            'position' => $this->position,
            'vendor_credit_number' => $this->vendorCreditNumber,
            'vendor_prepayment_number' => $this->vendorPrepaymentNumber,
            'id' => $this->id,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
