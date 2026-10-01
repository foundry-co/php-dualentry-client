<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum FixedAssetStatus: string
{
    case Active = 'ACTIVE';
    case Inactive = 'INACTIVE';
    case Disposed = 'DISPOSED';
    case FullyAmortized = 'FULLY_AMORTIZED';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'active' => self::Active,
            'inactive' => self::Inactive,
            'disposed' => self::Disposed,
            'fully_amortized' => self::FullyAmortized,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Active => 'active',
            self::Inactive => 'inactive',
            self::Disposed => 'disposed',
            self::FullyAmortized => 'fully_amortized',
        };
    }
}
