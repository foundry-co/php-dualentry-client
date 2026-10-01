<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum QuoteHeadlineTotal: string
{
    case Tcv = 'TCV';
    case Annual = 'ANNUAL';
    case Quarterly = 'QUARTERLY';
    case Monthly = 'MONTHLY';
    case FirstYear = 'FIRST_YEAR';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'tcv' => self::Tcv,
            'annual' => self::Annual,
            'quarterly' => self::Quarterly,
            'monthly' => self::Monthly,
            'first_year' => self::FirstYear,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Tcv => 'tcv',
            self::Annual => 'annual',
            self::Quarterly => 'quarterly',
            self::Monthly => 'monthly',
            self::FirstYear => 'first_year',
        };
    }
}
