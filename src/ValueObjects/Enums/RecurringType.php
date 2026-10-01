<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum RecurringType: string
{
    case Automatic = 'AUTOMATIC';
    case Reminder = 'REMINDER';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'automatic' => self::Automatic,
            'reminder' => self::Reminder,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Automatic => 'automatic',
            self::Reminder => 'reminder',
        };
    }
}
