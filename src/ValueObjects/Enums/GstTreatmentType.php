<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum GstTreatmentType: string
{
    case Standard = 'STANDARD';
    case ZeroRated = 'ZERO_RATED';
    case Exempt = 'EXEMPT';
    case ImportGst = 'IMPORT_GST';
    case ReverseCharge = 'REVERSE_CHARGE';
    case SelfAssessed = 'SELF_ASSESSED';
    case OutOfScope = 'OUT_OF_SCOPE';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'STANDARD' => self::Standard,
            'ZERO_RATED' => self::ZeroRated,
            'EXEMPT' => self::Exempt,
            'IMPORT_GST' => self::ImportGst,
            'REVERSE_CHARGE' => self::ReverseCharge,
            'SELF_ASSESSED' => self::SelfAssessed,
            'OUT_OF_SCOPE' => self::OutOfScope,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Standard => 'STANDARD',
            self::ZeroRated => 'ZERO_RATED',
            self::Exempt => 'EXEMPT',
            self::ImportGst => 'IMPORT_GST',
            self::ReverseCharge => 'REVERSE_CHARGE',
            self::SelfAssessed => 'SELF_ASSESSED',
            self::OutOfScope => 'OUT_OF_SCOPE',
        };
    }
}
