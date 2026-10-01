<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum Sources: string
{
    case Internal = 'INTERNAL';
    case Avalara = 'AVALARA';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'INTERNAL' => self::Internal,
            'AVALARA' => self::Avalara,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Internal => 'INTERNAL',
            self::Avalara => 'AVALARA',
        };
    }
}
