<?php

namespace FoundryCo\DualEntry\ValueObjects;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;

/**
 * Tax applied to a single line item.
 */
final class ItemTax
{
    use ImmutableAttributes;

    public function __construct(
        public readonly string $code,
        public readonly string $rate,
        public readonly string $amount,
        public readonly ?bool $isTaxable = null,
        public readonly ?string $taxExemptAmount = null,
        public readonly ?int $vatRateId = null,
        public readonly ?int $gstTaxRateId = null,
        public readonly array $taxMetadata = [],
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            code: $data['code'],
            rate: $data['rate'],
            amount: $data['amount'],
            isTaxable: $data['is_taxable'] ?? null,
            taxExemptAmount: $data['tax_exempt_amount'] ?? null,
            vatRateId: $data['vat_rate_id'] ?? null,
            gstTaxRateId: $data['gst_tax_rate_id'] ?? null,
            taxMetadata: $data['tax_metadata'] ?? [],
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'code' => $this->code,
            'rate' => $this->rate,
            'amount' => $this->amount,
            'is_taxable' => $this->isTaxable,
            'tax_exempt_amount' => $this->taxExemptAmount,
            'vat_rate_id' => $this->vatRateId,
            'gst_tax_rate_id' => $this->gstTaxRateId,
            'tax_metadata' => $this->taxMetadata !== [] ? $this->taxMetadata : null,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
