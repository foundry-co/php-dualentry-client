<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum SalesOrderInvoicedStatus: string
{
    case Invoiced = 'INVOICED';
    case Uninvoiced = 'UNINVOICED';
    case PartiallyInvoiced = 'PARTIALLY_INVOICED';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'invoiced' => self::Invoiced,
            'uninvoiced' => self::Uninvoiced,
            'partially_invoiced' => self::PartiallyInvoiced,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Invoiced => 'invoiced',
            self::Uninvoiced => 'uninvoiced',
            self::PartiallyInvoiced => 'partially_invoiced',
        };
    }
}
