<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\RecordClassification;

/**
 * @method $this withPosition(int $position)
 * @method $this withAccountNumber(int $accountNumber)
 * @method $this withRate(string $rate)
 * @method $this withQuantity(string $quantity)
 * @method $this withTax(?array $tax)
 * @method $this withIsBillable(?bool $isBillable)
 * @method $this withBillableCustomerId(?int $billableCustomerId)
 * @method $this withBillableProjectId(?int $billableProjectId)
 * @method $this withBillableMarkupPct(?string $billableMarkupPct)
 * @method $this withId(?int $id)
 * @method $this withExpenseDescription(?string $expenseDescription)
 * @method $this withClassifications(?array $classifications)
 * @method $this withCustomerId(?int $customerId)
 * @method $this withVendorId(?int $vendorId)
 * @method $this withCompanyId(?int $companyId)
 * @method $this withAmortizableAssets(?array $amortizableAssets)
 * @method $this withFixedAssets(?array $fixedAssets)
 * @method $this withBillableCustomerName(?string $billableCustomerName)
 * @method $this withBillableProjectName(?string $billableProjectName)
 * @method $this withBankOrCreditCardAmount(?string $bankOrCreditCardAmount)
 * @method $this withCustomerName(?string $customerName)
 * @method $this withVendorName(?string $vendorName)
 * @method $this withNetAmount(?string $netAmount)
 * @method $this withTaxAmount(?string $taxAmount)
 * @method $this withGrossAmount(?string $grossAmount)
 * @method $this withAmount(?string $amount)
 */
final class DirectExpenseLineItem
{
    use ImmutableAttributes;

    public function __construct(
        public readonly int $position,
        public readonly int $accountNumber,
        public readonly string $rate,
        public readonly string $quantity,
        public readonly ?array $tax = null,
        public readonly ?bool $isBillable = null,
        public readonly ?int $billableCustomerId = null,
        public readonly ?int $billableProjectId = null,
        public readonly ?string $billableMarkupPct = null,
        public readonly ?int $id = null,
        public readonly ?string $expenseDescription = null,
        /** @var array<int, RecordClassification> */
        public readonly ?array $classifications = null,
        public readonly ?int $customerId = null,
        public readonly ?int $vendorId = null,
        public readonly ?int $companyId = null,
        public readonly ?array $amortizableAssets = null,
        public readonly ?array $fixedAssets = null,
        public readonly ?string $billableCustomerName = null,
        public readonly ?string $billableProjectName = null,
        public readonly ?string $bankOrCreditCardAmount = null,
        public readonly ?string $customerName = null,
        public readonly ?string $vendorName = null,
        public readonly ?string $netAmount = null,
        public readonly ?string $taxAmount = null,
        public readonly ?string $grossAmount = null,
        public readonly ?string $amount = null,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            position: $data['position'],
            accountNumber: $data['account_number'],
            rate: $data['rate'],
            quantity: $data['quantity'],
            tax: $data['tax'] ?? null,
            isBillable: $data['is_billable'] ?? null,
            billableCustomerId: $data['billable_customer_id'] ?? null,
            billableProjectId: $data['billable_project_id'] ?? null,
            billableMarkupPct: $data['billable_markup_pct'] ?? null,
            id: $data['id'] ?? null,
            expenseDescription: $data['expense_description'] ?? null,
            classifications: array_map(static fn (array $row): RecordClassification => RecordClassification::fromWire($row), $data['classifications'] ?? []),
            customerId: $data['customer_id'] ?? null,
            vendorId: $data['vendor_id'] ?? null,
            companyId: $data['company_id'] ?? null,
            amortizableAssets: $data['amortizable_assets'] ?? null,
            fixedAssets: $data['fixed_assets'] ?? null,
            billableCustomerName: $data['billable_customer_name'] ?? null,
            billableProjectName: $data['billable_project_name'] ?? null,
            bankOrCreditCardAmount: $data['bank_or_credit_card_amount'] ?? null,
            customerName: $data['customer_name'] ?? null,
            vendorName: $data['vendor_name'] ?? null,
            netAmount: $data['net_amount'] ?? null,
            taxAmount: $data['tax_amount'] ?? null,
            grossAmount: $data['gross_amount'] ?? null,
            amount: $data['amount'] ?? null,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'position' => $this->position,
            'account_number' => $this->accountNumber,
            'rate' => $this->rate,
            'quantity' => $this->quantity,
            'tax' => $this->tax,
            'is_billable' => $this->isBillable,
            'billable_customer_id' => $this->billableCustomerId,
            'billable_project_id' => $this->billableProjectId,
            'billable_markup_pct' => $this->billableMarkupPct,
            'id' => $this->id,
            'expense_description' => $this->expenseDescription,
            'classifications' => array_map(static fn (RecordClassification $row): array => $row->toWire(), $this->classifications),
            'customer_id' => $this->customerId,
            'vendor_id' => $this->vendorId,
            'company_id' => $this->companyId,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
