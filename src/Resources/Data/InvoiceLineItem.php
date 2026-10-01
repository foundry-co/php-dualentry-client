<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\DiscountType;
use FoundryCo\DualEntry\ValueObjects\RecordClassification;

/**
 * @method $this withItemId(int $itemId)
 * @method $this withQuantity(string $quantity)
 * @method $this withRate(string $rate)
 * @method $this withPosition(int $position)
 * @method $this withMemo(string $memo)
 * @method $this withAccountId(?int $accountId)
 * @method $this withClassifications(?array $classifications)
 * @method $this withItemType(?string $itemType)
 * @method $this withHsnSacCode(?string $hsnSacCode)
 * @method $this withDiscountType(?DiscountType $discountType)
 * @method $this withDiscountValue(?string $discountValue)
 * @method $this withDiscountAccountId(?int $discountAccountId)
 * @method $this withRecordLevelDiscountAmount(?string $recordLevelDiscountAmount)
 * @method $this withTax(?array $tax)
 * @method $this withId(?int $id)
 * @method $this withCompanyId(?int $companyId)
 * @method $this withNetAmount(?string $netAmount)
 * @method $this withTaxAmount(?string $taxAmount)
 * @method $this withGrossAmount(?string $grossAmount)
 * @method $this withAmount(?string $amount)
 * @method $this withDiscountAmount(?string $discountAmount)
 */
final class InvoiceLineItem
{
    use ImmutableAttributes;

    public function __construct(
        public readonly int $itemId,
        public readonly string $quantity,
        public readonly string $rate,
        public readonly int $position,
        public readonly string $memo,
        public readonly ?int $accountId = null,
        /** @var array<int, RecordClassification> */
        public readonly ?array $classifications = null,
        public readonly ?string $itemType = null,
        public readonly ?string $hsnSacCode = null,
        public readonly ?DiscountType $discountType = null,
        public readonly ?string $discountValue = null,
        public readonly ?int $discountAccountId = null,
        public readonly ?string $recordLevelDiscountAmount = null,
        public readonly ?array $tax = null,
        public readonly ?int $id = null,
        public readonly ?int $companyId = null,
        public readonly ?string $netAmount = null,
        public readonly ?string $taxAmount = null,
        public readonly ?string $grossAmount = null,
        public readonly ?string $amount = null,
        public readonly ?string $discountAmount = null,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            itemId: $data['item_id'],
            quantity: $data['quantity'],
            rate: $data['rate'],
            position: $data['position'],
            memo: $data['memo'],
            accountId: $data['account_id'] ?? null,
            classifications: array_map(static fn (array $row): RecordClassification => RecordClassification::fromWire($row), $data['classifications'] ?? []),
            itemType: $data['item_type'] ?? null,
            hsnSacCode: $data['hsn_sac_code'] ?? null,
            discountType: isset($data['discount_type']) ? DiscountType::fromWire($data['discount_type']) : null,
            discountValue: $data['discount_value'] ?? null,
            discountAccountId: $data['discount_account_id'] ?? null,
            recordLevelDiscountAmount: $data['record_level_discount_amount'] ?? null,
            tax: $data['tax'] ?? null,
            id: $data['id'] ?? null,
            companyId: $data['company_id'] ?? null,
            netAmount: $data['net_amount'] ?? null,
            taxAmount: $data['tax_amount'] ?? null,
            grossAmount: $data['gross_amount'] ?? null,
            amount: $data['amount'] ?? null,
            discountAmount: $data['discount_amount'] ?? null,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'item_id' => $this->itemId,
            'quantity' => $this->quantity,
            'rate' => $this->rate,
            'position' => $this->position,
            'memo' => $this->memo,
            'classifications' => array_map(static fn (RecordClassification $row): array => $row->toWire(), $this->classifications),
            'discount_type' => $this->discountType?->toWire(),
            'discount_value' => $this->discountValue,
            'discount_account_id' => $this->discountAccountId,
            'record_level_discount_amount' => $this->recordLevelDiscountAmount,
            'tax' => $this->tax,
            'id' => $this->id,
            'company_id' => $this->companyId,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
