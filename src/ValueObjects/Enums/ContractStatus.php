<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum ContractStatus: string
{
    case Draft = 'DRAFT';
    case Active = 'ACTIVE';
    case Completed = 'COMPLETED';
    case Terminated = 'TERMINATED';
    case Archived = 'ARCHIVED';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'draft' => self::Draft,
            'active' => self::Active,
            'completed' => self::Completed,
            'terminated' => self::Terminated,
            'archived' => self::Archived,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Draft => 'draft',
            self::Active => 'active',
            self::Completed => 'completed',
            self::Terminated => 'terminated',
            self::Archived => 'archived',
        };
    }
}
