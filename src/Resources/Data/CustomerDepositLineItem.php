<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\RecordClassification;

/**
 * @method $this withPosition(int $position)
 * @method $this withAmount(string $amount)
 * @method $this withClassifications(?array $classifications)
 * @method $this withId(?int $id)
 * @method $this withCustomerPrepaymentNumber(?int $customerPrepaymentNumber)
 * @method $this withCustomerPaymentNumber(?int $customerPaymentNumber)
 * @method $this withCashSaleNumber(?int $cashSaleNumber)
 * @method $this withVendorRefundNumber(?int $vendorRefundNumber)
 * @method $this withAccountId(?int $accountId)
 * @method $this withDescription(?string $description)
 * @method $this withCustomerId(?int $customerId)
 * @method $this withVendorId(?int $vendorId)
 * @method $this withAccountNumber(?int $accountNumber)
 */
final class CustomerDepositLineItem
{
    use ImmutableAttributes;

    public function __construct(
        public readonly int $position,
        public readonly string $amount,
        /** @var array<int, RecordClassification> */
        public readonly ?array $classifications = null,
        public readonly ?int $id = null,
        public readonly ?int $customerPrepaymentNumber = null,
        public readonly ?int $customerPaymentNumber = null,
        public readonly ?int $cashSaleNumber = null,
        public readonly ?int $vendorRefundNumber = null,
        public readonly ?int $accountId = null,
        public readonly ?string $description = null,
        public readonly ?int $customerId = null,
        public readonly ?int $vendorId = null,
        public readonly ?int $accountNumber = null,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            position: $data['position'],
            amount: $data['amount'],
            classifications: array_map(static fn (array $row): RecordClassification => RecordClassification::fromWire($row), $data['classifications'] ?? []),
            id: $data['id'] ?? null,
            customerPrepaymentNumber: $data['customer_prepayment_number'] ?? null,
            customerPaymentNumber: $data['customer_payment_number'] ?? null,
            cashSaleNumber: $data['cash_sale_number'] ?? null,
            vendorRefundNumber: $data['vendor_refund_number'] ?? null,
            accountId: $data['account_id'] ?? null,
            description: $data['description'] ?? null,
            customerId: $data['customer_id'] ?? null,
            vendorId: $data['vendor_id'] ?? null,
            accountNumber: $data['account_number'] ?? null,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'position' => $this->position,
            'amount' => $this->amount,
            'id' => $this->id,
            'customer_prepayment_number' => $this->customerPrepaymentNumber,
            'customer_payment_number' => $this->customerPaymentNumber,
            'cash_sale_number' => $this->cashSaleNumber,
            'vendor_refund_number' => $this->vendorRefundNumber,
            'description' => $this->description,
            'customer_id' => $this->customerId,
            'vendor_id' => $this->vendorId,
            'account_number' => $this->accountNumber,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
