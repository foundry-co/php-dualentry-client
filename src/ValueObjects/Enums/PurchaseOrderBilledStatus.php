<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum PurchaseOrderBilledStatus: string
{
    case Billed = 'BILLED';
    case Unbilled = 'UNBILLED';
    case PartiallyBilled = 'PARTIALLY_BILLED';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'billed' => self::Billed,
            'unbilled' => self::Unbilled,
            'partially_billed' => self::PartiallyBilled,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Billed => 'billed',
            self::Unbilled => 'unbilled',
            self::PartiallyBilled => 'partially_billed',
        };
    }
}
