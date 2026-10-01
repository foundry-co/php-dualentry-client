<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum PaperCheckSourceRecordType: string
{
    case DirectExpense = 'DIRECT_EXPENSE';
    case VendorPayment = 'VENDOR_PAYMENT';
    case VendorPrepayment = 'VENDOR_PREPAYMENT';
    case CustomerRefund = 'CUSTOMER_REFUND';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'direct_expense' => self::DirectExpense,
            'vendor_payment' => self::VendorPayment,
            'vendor_prepayment' => self::VendorPrepayment,
            'customer_refund' => self::CustomerRefund,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::DirectExpense => 'direct_expense',
            self::VendorPayment => 'vendor_payment',
            self::VendorPrepayment => 'vendor_prepayment',
            self::CustomerRefund => 'customer_refund',
        };
    }
}
