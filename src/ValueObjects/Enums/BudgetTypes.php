<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum BudgetTypes: string
{
    case IncomeStatement = 'INCOME_STATEMENT';
    case BalanceSheet = 'BALANCE_SHEET';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'income_statement' => self::IncomeStatement,
            'balance_sheet' => self::BalanceSheet,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::IncomeStatement => 'income_statement',
            self::BalanceSheet => 'balance_sheet',
        };
    }
}
