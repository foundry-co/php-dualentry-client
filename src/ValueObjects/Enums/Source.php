<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum Source: string
{
    case Manual = 'MANUAL';
    case BankMatchAi = 'BANK_MATCH_AI';
    case BankMatchRule = 'BANK_MATCH_RULE';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'manual' => self::Manual,
            'bank_match_ai' => self::BankMatchAi,
            'bank_match_rule' => self::BankMatchRule,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Manual => 'manual',
            self::BankMatchAi => 'bank_match_ai',
            self::BankMatchRule => 'bank_match_rule',
        };
    }
}
