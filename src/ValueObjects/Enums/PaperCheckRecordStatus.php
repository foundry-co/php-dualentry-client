<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum PaperCheckRecordStatus: string
{
    case Printed = 'PRINTED';
    case NotPrinted = 'NOT_PRINTED';
    case Archived = 'ARCHIVED';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'printed' => self::Printed,
            'not_printed' => self::NotPrinted,
            'archived' => self::Archived,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Printed => 'printed',
            self::NotPrinted => 'not_printed',
            self::Archived => 'archived',
        };
    }
}
