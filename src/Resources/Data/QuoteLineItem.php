<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\BillingCadence;
use FoundryCo\DualEntry\ValueObjects\Enums\DiscountType;
use FoundryCo\DualEntry\ValueObjects\ItemTax;

/**
 * @method $this withItemId(int $itemId)
 * @method $this withQuantity(string $quantity)
 * @method $this withRate(string $rate)
 * @method $this withPosition(int $position)
 * @method $this withDiscountType(?DiscountType $discountType)
 * @method $this withDiscountValue(?string $discountValue)
 * @method $this withTax(?ItemTax $tax)
 * @method $this withId(?int $id)
 * @method $this withMemo(?string $memo)
 * @method $this withBillingFrequency(?BillingCadence $billingFrequency)
 * @method $this withBillingInterval(?int $billingInterval)
 * @method $this withBillingStartDate(?string $billingStartDate)
 * @method $this withBillingEndDate(?string $billingEndDate)
 * @method $this withRampGroupId(?string $rampGroupId)
 */
final class QuoteLineItem
{
    use ImmutableAttributes;

    public function __construct(
        public readonly int $itemId,
        public readonly string $quantity,
        public readonly string $rate,
        public readonly int $position,
        public readonly ?DiscountType $discountType = null,
        public readonly ?string $discountValue = null,
        public readonly ?ItemTax $tax = null,
        public readonly ?int $id = null,
        public readonly ?string $memo = null,
        public readonly ?BillingCadence $billingFrequency = null,
        public readonly ?int $billingInterval = null,
        public readonly ?string $billingStartDate = null,
        public readonly ?string $billingEndDate = null,
        public readonly ?string $rampGroupId = null,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            itemId: $data['item_id'],
            quantity: $data['quantity'],
            rate: $data['rate'],
            position: $data['position'],
            discountType: isset($data['discount_type']) ? DiscountType::fromWire($data['discount_type']) : null,
            discountValue: $data['discount_value'] ?? null,
            tax: isset($data['tax']) ? ItemTax::fromWire($data['tax']) : null,
            id: $data['id'] ?? null,
            memo: $data['memo'] ?? null,
            billingFrequency: isset($data['billing_frequency']) ? BillingCadence::fromWire($data['billing_frequency']) : null,
            billingInterval: $data['billing_interval'] ?? null,
            billingStartDate: $data['billing_start_date'] ?? null,
            billingEndDate: $data['billing_end_date'] ?? null,
            rampGroupId: $data['ramp_group_id'] ?? null,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'item_id' => $this->itemId,
            'quantity' => $this->quantity,
            'rate' => $this->rate,
            'position' => $this->position,
            'discount_type' => $this->discountType?->toWire(),
            'discount_value' => $this->discountValue,
            'tax' => $this->tax?->toWire(),
            'id' => $this->id,
            'memo' => $this->memo,
            'billing_frequency' => $this->billingFrequency?->toWire(),
            'billing_interval' => $this->billingInterval,
            'billing_start_date' => $this->billingStartDate,
            'billing_end_date' => $this->billingEndDate,
            'ramp_group_id' => $this->rampGroupId,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
