<?php

namespace FoundryCo\DualEntry\ValueObjects;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;

/**
 * Entries are kept as raw arrays ({country, registration_number, ...}) —
 * their shape varies by tax jurisdiction and isn't worth a dedicated class.
 */
final class TaxRegistrationNumbers
{
    use ImmutableAttributes;

    public function __construct(
        public readonly array $company = [],
        public readonly array $counterparty = [],
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            company: $data['company'] ?? [],
            counterparty: $data['counterparty'] ?? [],
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'company' => $this->company,
            'counterparty' => $this->counterparty,
        ], static fn (array $v): bool => $v !== []);
    }
}
