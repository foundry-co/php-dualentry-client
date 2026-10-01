<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum VatTaxType: string
{
    case InputOutput = 'INPUT_OUTPUT';
    case ZeroRated = 'ZERO_RATED';
    case Exempt = 'EXEMPT';
    case ReverseCharge = 'REVERSE_CHARGE';
    case OutOfScope = 'OUT_OF_SCOPE';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'INPUT_OUTPUT' => self::InputOutput,
            'ZERO_RATED' => self::ZeroRated,
            'EXEMPT' => self::Exempt,
            'REVERSE_CHARGE' => self::ReverseCharge,
            'OUT_OF_SCOPE' => self::OutOfScope,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::InputOutput => 'INPUT_OUTPUT',
            self::ZeroRated => 'ZERO_RATED',
            self::Exempt => 'EXEMPT',
            self::ReverseCharge => 'REVERSE_CHARGE',
            self::OutOfScope => 'OUT_OF_SCOPE',
        };
    }
}
