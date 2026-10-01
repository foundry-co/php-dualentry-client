<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum SystemAccountNames: string
{
    case AccountsReceivable = 'ACCOUNTS_RECEIVABLE';
    case IcAccountsReceivable = 'IC_ACCOUNTS_RECEIVABLE';
    case IcDueFrom = 'IC_DUE_FROM';
    case VendorDeposits = 'VENDOR_DEPOSITS';
    case UndepositedFunds = 'UNDEPOSITED_FUNDS';
    case AccumulatedDepreciation = 'ACCUMULATED_DEPRECIATION';
    case AccountsPayable = 'ACCOUNTS_PAYABLE';
    case IcAccountsPayable = 'IC_ACCOUNTS_PAYABLE';
    case IcDueTo = 'IC_DUE_TO';
    case CustomerDeposits = 'CUSTOMER_DEPOSITS';
    case TaxPayable = 'TAX_PAYABLE';
    case AccruedPurchases = 'ACCRUED_PURCHASES';
    case DeferredRevenue = 'DEFERRED_REVENUE';
    case CumulativeTranslationAdjustmentElimination = 'CUMULATIVE_TRANSLATION_ADJUSTMENT_ELIMINATION';
    case CumulativeTranslationAdjustment = 'CUMULATIVE_TRANSLATION_ADJUSTMENT';
    case RetainedEarnings = 'RETAINED_EARNINGS';
    case NetIncome = 'NET_INCOME';
    case RealizedGainLoss = 'REALIZED_GAIN_LOSS';
    case UnrealizedGainLoss = 'UNREALIZED_GAIN_LOSS';
    case MatchingGainLoss = 'MATCHING_GAIN_LOSS';
    case RoundingGainLoss = 'ROUNDING_GAIN_LOSS';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'Accounts Receivable' => self::AccountsReceivable,
            'IC Accounts Receivable' => self::IcAccountsReceivable,
            'IC Due From' => self::IcDueFrom,
            'Vendor Deposits' => self::VendorDeposits,
            'Undeposited Funds' => self::UndepositedFunds,
            'Accumulated Depreciation' => self::AccumulatedDepreciation,
            'Accounts Payable' => self::AccountsPayable,
            'IC Accounts Payable' => self::IcAccountsPayable,
            'IC Due To' => self::IcDueTo,
            'Customer Deposits' => self::CustomerDeposits,
            'Tax Payable' => self::TaxPayable,
            'Accrued Purchases' => self::AccruedPurchases,
            'Deferred Revenue' => self::DeferredRevenue,
            'Cumulative Translation Adjustment - Elimination' => self::CumulativeTranslationAdjustmentElimination,
            'Cumulative Translation Adjustment' => self::CumulativeTranslationAdjustment,
            'Retained Earnings' => self::RetainedEarnings,
            'Net Income' => self::NetIncome,
            'Realized Gain/Loss' => self::RealizedGainLoss,
            'Unrealized Gain/Loss' => self::UnrealizedGainLoss,
            'Matching Gain/Loss' => self::MatchingGainLoss,
            'Rounding Gain/Loss' => self::RoundingGainLoss,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::AccountsReceivable => 'Accounts Receivable',
            self::IcAccountsReceivable => 'IC Accounts Receivable',
            self::IcDueFrom => 'IC Due From',
            self::VendorDeposits => 'Vendor Deposits',
            self::UndepositedFunds => 'Undeposited Funds',
            self::AccumulatedDepreciation => 'Accumulated Depreciation',
            self::AccountsPayable => 'Accounts Payable',
            self::IcAccountsPayable => 'IC Accounts Payable',
            self::IcDueTo => 'IC Due To',
            self::CustomerDeposits => 'Customer Deposits',
            self::TaxPayable => 'Tax Payable',
            self::AccruedPurchases => 'Accrued Purchases',
            self::DeferredRevenue => 'Deferred Revenue',
            self::CumulativeTranslationAdjustmentElimination => 'Cumulative Translation Adjustment - Elimination',
            self::CumulativeTranslationAdjustment => 'Cumulative Translation Adjustment',
            self::RetainedEarnings => 'Retained Earnings',
            self::NetIncome => 'Net Income',
            self::RealizedGainLoss => 'Realized Gain/Loss',
            self::UnrealizedGainLoss => 'Unrealized Gain/Loss',
            self::MatchingGainLoss => 'Matching Gain/Loss',
            self::RoundingGainLoss => 'Rounding Gain/Loss',
        };
    }
}
