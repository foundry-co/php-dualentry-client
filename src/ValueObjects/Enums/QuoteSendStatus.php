<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum QuoteSendStatus: string
{
    case Draft = 'DRAFT';
    case AwaitingApproval = 'AWAITING_APPROVAL';
    case Approved = 'APPROVED';
    case Rejected = 'REJECTED';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'draft' => self::Draft,
            'awaiting_approval' => self::AwaitingApproval,
            'approved' => self::Approved,
            'rejected' => self::Rejected,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Draft => 'draft',
            self::AwaitingApproval => 'awaiting_approval',
            self::Approved => 'approved',
            self::Rejected => 'rejected',
        };
    }
}
