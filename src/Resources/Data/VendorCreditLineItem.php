<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\RecordClassification;

/**
 * @method $this withPosition(int $position)
 * @method $this withItemId(int $itemId)
 * @method $this withRate(string $rate)
 * @method $this withQuantity(string $quantity)
 * @method $this withClassifications(?array $classifications)
 * @method $this withItemType(?string $itemType)
 * @method $this withHsnSacCode(?string $hsnSacCode)
 * @method $this withTax(?array $tax)
 * @method $this withIsBillable(?bool $isBillable)
 * @method $this withBillableCustomerId(?int $billableCustomerId)
 * @method $this withBillableCustomerName(?string $billableCustomerName)
 * @method $this withBillableProjectId(?int $billableProjectId)
 * @method $this withBillableProjectName(?string $billableProjectName)
 * @method $this withBillableMarkupPct(?string $billableMarkupPct)
 * @method $this withId(?int $id)
 * @method $this withLineType(?string $lineType)
 * @method $this withItemName(?string $itemName)
 * @method $this withMemo(?string $memo)
 * @method $this withAccountNumber(?int $accountNumber)
 * @method $this withAccountName(?string $accountName)
 * @method $this withExpenseDescription(?string $expenseDescription)
 * @method $this withCustomerId(?int $customerId)
 * @method $this withCustomerName(?string $customerName)
 * @method $this withVendorId(?int $vendorId)
 * @method $this withVendorName(?string $vendorName)
 * @method $this withCompanyId(?int $companyId)
 * @method $this withNetAmount(?string $netAmount)
 * @method $this withTaxAmount(?string $taxAmount)
 * @method $this withGrossAmount(?string $grossAmount)
 * @method $this withAmount(?string $amount)
 */
final class VendorCreditLineItem
{
    use ImmutableAttributes;

    public function __construct(
        public readonly int $position,
        public readonly int $itemId,
        public readonly string $rate,
        public readonly string $quantity,
        /** @var array<int, RecordClassification> */
        public readonly ?array $classifications = null,
        public readonly ?string $itemType = null,
        public readonly ?string $hsnSacCode = null,
        public readonly ?array $tax = null,
        public readonly ?bool $isBillable = null,
        public readonly ?int $billableCustomerId = null,
        public readonly ?string $billableCustomerName = null,
        public readonly ?int $billableProjectId = null,
        public readonly ?string $billableProjectName = null,
        public readonly ?string $billableMarkupPct = null,
        public readonly ?int $id = null,
        public readonly ?string $lineType = null,
        public readonly ?string $itemName = null,
        public readonly ?string $memo = null,
        public readonly ?int $accountNumber = null,
        public readonly ?string $accountName = null,
        public readonly ?string $expenseDescription = null,
        public readonly ?int $customerId = null,
        public readonly ?string $customerName = null,
        public readonly ?int $vendorId = null,
        public readonly ?string $vendorName = null,
        public readonly ?int $companyId = null,
        public readonly ?string $netAmount = null,
        public readonly ?string $taxAmount = null,
        public readonly ?string $grossAmount = null,
        public readonly ?string $amount = null,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            position: $data['position'],
            itemId: $data['item_id'],
            rate: $data['rate'],
            quantity: $data['quantity'],
            classifications: array_map(static fn (array $row): RecordClassification => RecordClassification::fromWire($row), $data['classifications'] ?? []),
            itemType: $data['item_type'] ?? null,
            hsnSacCode: $data['hsn_sac_code'] ?? null,
            tax: $data['tax'] ?? null,
            isBillable: $data['is_billable'] ?? null,
            billableCustomerId: $data['billable_customer_id'] ?? null,
            billableCustomerName: $data['billable_customer_name'] ?? null,
            billableProjectId: $data['billable_project_id'] ?? null,
            billableProjectName: $data['billable_project_name'] ?? null,
            billableMarkupPct: $data['billable_markup_pct'] ?? null,
            id: $data['id'] ?? null,
            lineType: $data['line_type'] ?? null,
            itemName: $data['item_name'] ?? null,
            memo: $data['memo'] ?? null,
            accountNumber: $data['account_number'] ?? null,
            accountName: $data['account_name'] ?? null,
            expenseDescription: $data['expense_description'] ?? null,
            customerId: $data['customer_id'] ?? null,
            customerName: $data['customer_name'] ?? null,
            vendorId: $data['vendor_id'] ?? null,
            vendorName: $data['vendor_name'] ?? null,
            companyId: $data['company_id'] ?? null,
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
            'item_id' => $this->itemId,
            'rate' => $this->rate,
            'quantity' => $this->quantity,
            'classifications' => array_map(static fn (RecordClassification $row): array => $row->toWire(), $this->classifications),
            'tax' => $this->tax,
            'is_billable' => $this->isBillable,
            'billable_customer_id' => $this->billableCustomerId,
            'billable_project_id' => $this->billableProjectId,
            'billable_markup_pct' => $this->billableMarkupPct,
            'id' => $this->id,
            'memo' => $this->memo,
            'company_id' => $this->companyId,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
