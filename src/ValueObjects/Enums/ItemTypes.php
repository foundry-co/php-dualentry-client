<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum ItemTypes: string
{
    case Service = 'SERVICE';
    case Discount = 'DISCOUNT';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'service' => self::Service,
            'discount' => self::Discount,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Service => 'service',
            self::Discount => 'discount',
        };
    }
}
