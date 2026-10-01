<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum BillingCadence: string
{
    case OneTime = 'ONE_TIME';
    case Daily = 'DAILY';
    case Weekly = 'WEEKLY';
    case Monthly = 'MONTHLY';
    case Quarterly = 'QUARTERLY';
    case SemiAnnually = 'SEMI_ANNUALLY';
    case Annually = 'ANNUALLY';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'one_time' => self::OneTime,
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
            self::OneTime => 'one_time',
            self::Daily => 'daily',
            self::Weekly => 'weekly',
            self::Monthly => 'monthly',
            self::Quarterly => 'quarterly',
            self::SemiAnnually => 'semi_annually',
            self::Annually => 'annually',
        };
    }
}
