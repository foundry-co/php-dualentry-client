<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum PublicExportJobStatus: string
{
    case Pending = 'PENDING';
    case Running = 'RUNNING';
    case Completed = 'COMPLETED';
    case Failed = 'FAILED';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'pending' => self::Pending,
            'running' => self::Running,
            'completed' => self::Completed,
            'failed' => self::Failed,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Pending => 'pending',
            self::Running => 'running',
            self::Completed => 'completed',
            self::Failed => 'failed',
        };
    }
}
