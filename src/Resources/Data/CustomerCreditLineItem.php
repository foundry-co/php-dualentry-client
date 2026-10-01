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
 * @method $this withMemo(?string $memo)
 * @method $this withCompanyId(?int $companyId)
 * @method $this withNetAmount(?string $netAmount)
 * @method $this withTaxAmount(?string $taxAmount)
 * @method $this withGrossAmount(?string $grossAmount)
 * @method $this withAmount(?string $amount)
 * @method $this withId(?int $id)
 */
final class CustomerCreditLineItem
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
        public readonly ?string $memo = null,
        public readonly ?int $companyId = null,
        public readonly ?string $netAmount = null,
        public readonly ?string $taxAmount = null,
        public readonly ?string $grossAmount = null,
        public readonly ?string $amount = null,
        public readonly ?int $id = null,
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
            memo: $data['memo'] ?? null,
            companyId: $data['company_id'] ?? null,
            netAmount: $data['net_amount'] ?? null,
            taxAmount: $data['tax_amount'] ?? null,
            grossAmount: $data['gross_amount'] ?? null,
            amount: $data['amount'] ?? null,
            id: $data['id'] ?? null,
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
            'memo' => $this->memo,
            'company_id' => $this->companyId,
            'id' => $this->id,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
