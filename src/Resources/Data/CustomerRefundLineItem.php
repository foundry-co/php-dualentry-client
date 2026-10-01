<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;

/**
 * @method $this withAmount(string $amount)
 * @method $this withPosition(int $position)
 * @method $this withCustomerCreditNumber(?int $customerCreditNumber)
 * @method $this withCustomerPrepaymentNumber(?int $customerPrepaymentNumber)
 * @method $this withBankOrCreditCardAmount(?string $bankOrCreditCardAmount)
 * @method $this withId(?int $id)
 */
final class CustomerRefundLineItem
{
    use ImmutableAttributes;

    public function __construct(
        public readonly string $amount,
        public readonly int $position,
        public readonly ?int $customerCreditNumber = null,
        public readonly ?int $customerPrepaymentNumber = null,
        public readonly ?string $bankOrCreditCardAmount = null,
        public readonly ?int $id = null,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            amount: $data['amount'],
            position: $data['position'],
            customerCreditNumber: $data['customer_credit_number'] ?? null,
            customerPrepaymentNumber: $data['customer_prepayment_number'] ?? null,
            bankOrCreditCardAmount: $data['bank_or_credit_card_amount'] ?? null,
            id: $data['id'] ?? null,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'amount' => $this->amount,
            'position' => $this->position,
            'customer_credit_number' => $this->customerCreditNumber,
            'customer_prepayment_number' => $this->customerPrepaymentNumber,
            'id' => $this->id,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
