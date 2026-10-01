<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum BankAccountType: string
{
    case Checking = 'CHECKING';
    case Savings = 'SAVINGS';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'checking' => self::Checking,
            'savings' => self::Savings,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Checking => 'checking',
            self::Savings => 'savings',
        };
    }
}
