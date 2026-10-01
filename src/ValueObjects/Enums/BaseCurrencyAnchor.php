<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum BaseCurrencyAnchor: string
{
    case Sending = 'SENDING';
    case Receiving = 'RECEIVING';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'sending' => self::Sending,
            'receiving' => self::Receiving,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Sending => 'sending',
            self::Receiving => 'receiving',
        };
    }
}
