<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum RecurringStatus: string
{
    case Active = 'ACTIVE';
    case Inactive = 'INACTIVE';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'active' => self::Active,
            'inactive' => self::Inactive,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Active => 'active',
            self::Inactive => 'inactive',
        };
    }
}
