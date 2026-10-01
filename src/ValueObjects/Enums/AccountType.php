<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum AccountType: string
{
    case Bank = 'BANK';
    case AccountsReceivable = 'ACCOUNTS_RECEIVABLE';
    case OtherCurrentAsset = 'OTHER_CURRENT_ASSET';
    case FixedAsset = 'FIXED_ASSET';
    case UnbilledReceivable = 'UNBILLED_RECEIVABLE';
    case DeferredExpense = 'DEFERRED_EXPENSE';
    case OtherAsset = 'OTHER_ASSET';
    case Investment = 'INVESTMENT';
    case AccountsPayable = 'ACCOUNTS_PAYABLE';
    case CreditCard = 'CREDIT_CARD';
    case DeferredRevenue = 'DEFERRED_REVENUE';
    case LongTermLiability = 'LONG_TERM_LIABILITY';
    case OtherCurrentLiability = 'OTHER_CURRENT_LIABILITY';
    case Equity = 'EQUITY';
    case Income = 'INCOME';
    case CostOfGoodsSold = 'COST_OF_GOODS_SOLD';
    case Expense = 'EXPENSE';
    case OtherIncome = 'OTHER_INCOME';
    case OtherExpense = 'OTHER_EXPENSE';
    case Statistical = 'STATISTICAL';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'bank' => self::Bank,
            'accounts_receivable' => self::AccountsReceivable,
            'other_current_asset' => self::OtherCurrentAsset,
            'fixed_asset' => self::FixedAsset,
            'unbilled_receivable' => self::UnbilledReceivable,
            'deferred_expense' => self::DeferredExpense,
            'other_asset' => self::OtherAsset,
            'investment' => self::Investment,
            'accounts_payable' => self::AccountsPayable,
            'credit_card' => self::CreditCard,
            'deferred_revenue' => self::DeferredRevenue,
            'long_term_liability' => self::LongTermLiability,
            'other_current_liability' => self::OtherCurrentLiability,
            'equity' => self::Equity,
            'income' => self::Income,
            'cost_of_goods_sold' => self::CostOfGoodsSold,
            'expense' => self::Expense,
            'other_income' => self::OtherIncome,
            'other_expense' => self::OtherExpense,
            'statistical' => self::Statistical,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Bank => 'bank',
            self::AccountsReceivable => 'accounts_receivable',
            self::OtherCurrentAsset => 'other_current_asset',
            self::FixedAsset => 'fixed_asset',
            self::UnbilledReceivable => 'unbilled_receivable',
            self::DeferredExpense => 'deferred_expense',
            self::OtherAsset => 'other_asset',
            self::Investment => 'investment',
            self::AccountsPayable => 'accounts_payable',
            self::CreditCard => 'credit_card',
            self::DeferredRevenue => 'deferred_revenue',
            self::LongTermLiability => 'long_term_liability',
            self::OtherCurrentLiability => 'other_current_liability',
            self::Equity => 'equity',
            self::Income => 'income',
            self::CostOfGoodsSold => 'cost_of_goods_sold',
            self::Expense => 'expense',
            self::OtherIncome => 'other_income',
            self::OtherExpense => 'other_expense',
            self::Statistical => 'statistical',
        };
    }
}
