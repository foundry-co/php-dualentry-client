<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\RecordClassification;

/**
 * @method $this withPosition(int $position)
 * @method $this withItemId(int $itemId)
 * @method $this withMemo(string $memo)
 * @method $this withQuantity(string $quantity)
 * @method $this withRate(string $rate)
 * @method $this withClassifications(array $classifications)
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
 * @method $this withQuantityBilled(?string $quantityBilled)
 * @method $this withQuantityDue(?string $quantityDue)
 * @method $this withExpectedLocationId(?int $expectedLocationId)
 * @method $this withExpectedLocationName(?string $expectedLocationName)
 * @method $this withNetAmount(?string $netAmount)
 * @method $this withTaxAmount(?string $taxAmount)
 * @method $this withGrossAmount(?string $grossAmount)
 * @method $this withAmount(?string $amount)
 */
final class PurchaseOrderLineItem
{
    use ImmutableAttributes;

    public function __construct(
        public readonly int $position,
        public readonly int $itemId,
        public readonly string $memo,
        public readonly string $quantity,
        public readonly string $rate,
        /** @var array<int, RecordClassification> */
        public readonly array $classifications,
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
        public readonly ?string $quantityBilled = null,
        public readonly ?string $quantityDue = null,
        public readonly ?int $expectedLocationId = null,
        public readonly ?string $expectedLocationName = null,
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
            memo: $data['memo'],
            quantity: $data['quantity'],
            rate: $data['rate'],
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
            quantityBilled: $data['quantity_billed'] ?? null,
            quantityDue: $data['quantity_due'] ?? null,
            expectedLocationId: $data['expected_location_id'] ?? null,
            expectedLocationName: $data['expected_location_name'] ?? null,
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
            'memo' => $this->memo,
            'quantity' => $this->quantity,
            'rate' => $this->rate,
            'classifications' => array_map(static fn (RecordClassification $row): array => $row->toWire(), $this->classifications),
            'tax' => $this->tax,
            'is_billable' => $this->isBillable,
            'billable_customer_id' => $this->billableCustomerId,
            'billable_project_id' => $this->billableProjectId,
            'billable_markup_pct' => $this->billableMarkupPct,
            'id' => $this->id,
            'expected_location_id' => $this->expectedLocationId,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
