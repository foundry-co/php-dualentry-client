<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum GstSupplyCategory: string
{
    case IntraState = 'INTRA_STATE';
    case InterState = 'INTER_STATE';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'INTRA_STATE' => self::IntraState,
            'INTER_STATE' => self::InterState,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::IntraState => 'INTRA_STATE',
            self::InterState => 'INTER_STATE',
        };
    }
}
