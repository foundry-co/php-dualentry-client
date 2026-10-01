<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum PurchaseOrderLifecycleStatus: string
{
    case Open = 'OPEN';
    case Closed = 'CLOSED';
    case Cancelled = 'CANCELLED';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'open' => self::Open,
            'closed' => self::Closed,
            'cancelled' => self::Cancelled,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Open => 'open',
            self::Closed => 'closed',
            self::Cancelled => 'cancelled',
        };
    }
}
