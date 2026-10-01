<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum RecognitionMode: string
{
    case Individual = 'INDIVIDUAL';
    case Subledger = 'SUBLEDGER';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'individual' => self::Individual,
            'subledger' => self::Subledger,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Individual => 'individual',
            self::Subledger => 'subledger',
        };
    }
}
