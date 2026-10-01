<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;

/**
 * @method $this withAmount(string $amount)
 * @method $this withPosition(int $position)
 * @method $this withInvoiceNumber(?int $invoiceNumber)
 * @method $this withCustomerCreditNumber(?int $customerCreditNumber)
 * @method $this withAccountId(?int $accountId)
 * @method $this withDescription(?string $description)
 * @method $this withCustomerId(?int $customerId)
 * @method $this withVendorId(?int $vendorId)
 * @method $this withBankOrUndepositedAccountAmount(?string $bankOrUndepositedAccountAmount)
 * @method $this withId(?int $id)
 * @method $this withAccountNumber(?int $accountNumber)
 */
final class CustomerPaymentLineItem
{
    use ImmutableAttributes;

    public function __construct(
        public readonly string $amount,
        public readonly int $position,
        public readonly ?int $invoiceNumber = null,
        public readonly ?int $customerCreditNumber = null,
        public readonly ?int $accountId = null,
        public readonly ?string $description = null,
        public readonly ?int $customerId = null,
        public readonly ?int $vendorId = null,
        public readonly ?string $bankOrUndepositedAccountAmount = null,
        public readonly ?int $id = null,
        public readonly ?int $accountNumber = null,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            amount: $data['amount'],
            position: $data['position'],
            invoiceNumber: $data['invoice_number'] ?? null,
            customerCreditNumber: $data['customer_credit_number'] ?? null,
            accountId: $data['account_id'] ?? null,
            description: $data['description'] ?? null,
            customerId: $data['customer_id'] ?? null,
            vendorId: $data['vendor_id'] ?? null,
            bankOrUndepositedAccountAmount: $data['bank_or_undeposited_account_amount'] ?? null,
            id: $data['id'] ?? null,
            accountNumber: $data['account_number'] ?? null,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'amount' => $this->amount,
            'position' => $this->position,
            'invoice_number' => $this->invoiceNumber,
            'customer_credit_number' => $this->customerCreditNumber,
            'description' => $this->description,
            'customer_id' => $this->customerId,
            'vendor_id' => $this->vendorId,
            'id' => $this->id,
            'account_number' => $this->accountNumber,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
