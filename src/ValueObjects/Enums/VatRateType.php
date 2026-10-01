<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum VatRateType: string
{
    case Standard = 'STANDARD';
    case Reduced = 'REDUCED';
    case SuperReduced = 'SUPER_REDUCED';
    case Parking = 'PARKING';
    case Zero = 'ZERO';
    case Exempt = 'EXEMPT';
    case OutOfScope = 'OUT_OF_SCOPE';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'STANDARD' => self::Standard,
            'REDUCED' => self::Reduced,
            'SUPER_REDUCED' => self::SuperReduced,
            'PARKING' => self::Parking,
            'ZERO' => self::Zero,
            'EXEMPT' => self::Exempt,
            'OUT_OF_SCOPE' => self::OutOfScope,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Standard => 'STANDARD',
            self::Reduced => 'REDUCED',
            self::SuperReduced => 'SUPER_REDUCED',
            self::Parking => 'PARKING',
            self::Zero => 'ZERO',
            self::Exempt => 'EXEMPT',
            self::OutOfScope => 'OUT_OF_SCOPE',
        };
    }
}
