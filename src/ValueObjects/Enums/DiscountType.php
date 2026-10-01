<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum DiscountType: string
{
    case Percentage = 'PERCENTAGE';
    case Fixed = 'FIXED';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'PERCENTAGE' => self::Percentage,
            'FIXED' => self::Fixed,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Percentage => 'PERCENTAGE',
            self::Fixed => 'FIXED',
        };
    }
}
