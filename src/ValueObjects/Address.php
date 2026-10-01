<?php

namespace FoundryCo\DualEntry\ValueObjects;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCountries;

final class Address
{
    use ImmutableAttributes;

    public function __construct(
        public readonly string $street,
        public readonly string $city,
        public readonly string $postalCode,
        public readonly ?string $state = null,
        public readonly ?SystemCountries $country = null,
        public readonly ?string $secondLine = null,
        public readonly ?string $name = null,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            street: $data['street'] ?? '',
            city: $data['city'] ?? '',
            postalCode: $data['postal_code'] ?? '',
            state: $data['state'] ?? null,
            country: ($data['country'] ?? '') !== '' ? SystemCountries::fromWire($data['country']) : null,
            secondLine: $data['second_line'] ?? null,
            name: $data['name'] ?? null,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'street' => $this->street,
            'city' => $this->city,
            'postal_code' => $this->postalCode,
            'state' => $this->state,
            'country' => $this->country?->toWire(),
            'second_line' => $this->secondLine,
            'name' => $this->name,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
