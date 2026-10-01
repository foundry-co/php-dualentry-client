<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum PublicRecordType: string
{
    case Invoice = 'INVOICE';
    case Bill = 'BILL';
    case JournalEntry = 'JOURNAL_ENTRY';
    case BankTransfer = 'BANK_TRANSFER';
    case PurchaseOrder = 'PURCHASE_ORDER';
    case SalesOrder = 'SALES_ORDER';
    case IntercompanyJournalEntry = 'INTERCOMPANY_JOURNAL_ENTRY';
    case Contract = 'CONTRACT';
    case CustomerCredit = 'CUSTOMER_CREDIT';
    case DirectExpense = 'DIRECT_EXPENSE';
    case CashSale = 'CASH_SALE';
    case CustomerPrepayment = 'CUSTOMER_PREPAYMENT';
    case CustomerDeposit = 'CUSTOMER_DEPOSIT';
    case CustomerPayment = 'CUSTOMER_PAYMENT';
    case CustomerRefund = 'CUSTOMER_REFUND';
    case VendorPrepaymentApplication = 'VENDOR_PREPAYMENT_APPLICATION';
    case CustomerPrepaymentApplication = 'CUSTOMER_PREPAYMENT_APPLICATION';
    case VendorPayment = 'VENDOR_PAYMENT';
    case VendorCredit = 'VENDOR_CREDIT';
    case VendorRefund = 'VENDOR_REFUND';
    case VendorPrepayment = 'VENDOR_PREPAYMENT';
    case Vendor = 'VENDOR';
    case Customer = 'CUSTOMER';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'invoice' => self::Invoice,
            'bill' => self::Bill,
            'journal_entry' => self::JournalEntry,
            'bank_transfer' => self::BankTransfer,
            'purchase_order' => self::PurchaseOrder,
            'sales_order' => self::SalesOrder,
            'intercompany_journal_entry' => self::IntercompanyJournalEntry,
            'contract' => self::Contract,
            'customer_credit' => self::CustomerCredit,
            'direct_expense' => self::DirectExpense,
            'cash_sale' => self::CashSale,
            'customer_prepayment' => self::CustomerPrepayment,
            'customer_deposit' => self::CustomerDeposit,
            'customer_payment' => self::CustomerPayment,
            'customer_refund' => self::CustomerRefund,
            'vendor_prepayment_application' => self::VendorPrepaymentApplication,
            'customer_prepayment_application' => self::CustomerPrepaymentApplication,
            'vendor_payment' => self::VendorPayment,
            'vendor_credit' => self::VendorCredit,
            'vendor_refund' => self::VendorRefund,
            'vendor_prepayment' => self::VendorPrepayment,
            'vendor' => self::Vendor,
            'customer' => self::Customer,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Invoice => 'invoice',
            self::Bill => 'bill',
            self::JournalEntry => 'journal_entry',
            self::BankTransfer => 'bank_transfer',
            self::PurchaseOrder => 'purchase_order',
            self::SalesOrder => 'sales_order',
            self::IntercompanyJournalEntry => 'intercompany_journal_entry',
            self::Contract => 'contract',
            self::CustomerCredit => 'customer_credit',
            self::DirectExpense => 'direct_expense',
            self::CashSale => 'cash_sale',
            self::CustomerPrepayment => 'customer_prepayment',
            self::CustomerDeposit => 'customer_deposit',
            self::CustomerPayment => 'customer_payment',
            self::CustomerRefund => 'customer_refund',
            self::VendorPrepaymentApplication => 'vendor_prepayment_application',
            self::CustomerPrepaymentApplication => 'customer_prepayment_application',
            self::VendorPayment => 'vendor_payment',
            self::VendorCredit => 'vendor_credit',
            self::VendorRefund => 'vendor_refund',
            self::VendorPrepayment => 'vendor_prepayment',
            self::Vendor => 'vendor',
            self::Customer => 'customer',
        };
    }
}
