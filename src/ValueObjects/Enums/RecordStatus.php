<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum RecordStatus: string
{
    case Draft = 'DRAFT';
    case Posted = 'POSTED';
    case Archived = 'ARCHIVED';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'draft' => self::Draft,
            'posted' => self::Posted,
            'archived' => self::Archived,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Draft => 'draft',
            self::Posted => 'posted',
            self::Archived => 'archived',
        };
    }
}
