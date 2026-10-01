<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum QuoteContractEndType: string
{
    case After = 'AFTER';
    case Ongoing = 'ONGOING';
    case Date = 'DATE';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'after' => self::After,
            'ongoing' => self::Ongoing,
            'date' => self::Date,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::After => 'after',
            self::Ongoing => 'ongoing',
            self::Date => 'date',
        };
    }
}
