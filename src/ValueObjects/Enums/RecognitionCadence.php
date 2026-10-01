<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum RecognitionCadence: string
{
    case Daily = 'DAILY';
    case Weekly = 'WEEKLY';
    case Monthly = 'MONTHLY';
    case Quarterly = 'QUARTERLY';
    case SemiAnnually = 'SEMI_ANNUALLY';
    case Annually = 'ANNUALLY';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'daily' => self::Daily,
            'weekly' => self::Weekly,
            'monthly' => self::Monthly,
            'quarterly' => self::Quarterly,
            'semi_annually' => self::SemiAnnually,
            'annually' => self::Annually,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Daily => 'daily',
            self::Weekly => 'weekly',
            self::Monthly => 'monthly',
            self::Quarterly => 'quarterly',
            self::SemiAnnually => 'semi_annually',
            self::Annually => 'annually',
        };
    }
}
