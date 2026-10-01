<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum RecognitionStrategy: string
{
    case StraightLine = 'STRAIGHT_LINE';
    case StraightLineStartEndEven = 'STRAIGHT_LINE_START_END_EVEN';
    case DailyProrata = 'DAILY_PRORATA';
    case Milestone = 'MILESTONE';
    case UsageTiered = 'USAGE_TIERED';
    case Usage = 'USAGE';
    case Immediate = 'IMMEDIATE';
    case DepositRelease = 'DEPOSIT_RELEASE';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'straight_line' => self::StraightLine,
            'straight_line_start_end_even' => self::StraightLineStartEndEven,
            'daily_prorata' => self::DailyProrata,
            'milestone' => self::Milestone,
            'usage_tiered' => self::UsageTiered,
            'usage' => self::Usage,
            'immediate' => self::Immediate,
            'deposit_release' => self::DepositRelease,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::StraightLine => 'straight_line',
            self::StraightLineStartEndEven => 'straight_line_start_end_even',
            self::DailyProrata => 'daily_prorata',
            self::Milestone => 'milestone',
            self::UsageTiered => 'usage_tiered',
            self::Usage => 'usage',
            self::Immediate => 'immediate',
            self::DepositRelease => 'deposit_release',
        };
    }
}
