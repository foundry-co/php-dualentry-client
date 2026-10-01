<?php

namespace FoundryCo\DualEntry\ValueObjects;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;

/**
 * Provider-specific tax metadata (currently only Avalara). Kept as a raw
 * array since its shape is entirely provider-defined.
 */
final class TaxMetadata
{
    use ImmutableAttributes;

    public function __construct(
        public readonly array $avalara = [],
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(avalara: $data['avalara'] ?? []);
    }

    public function toWire(): array
    {
        return array_filter(['avalara' => $this->avalara], static fn (array $v): bool => $v !== []);
    }
}
