<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\PaperCheckRecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;
use FoundryCo\DualEntry\ValueObjects\RecordClassification;

/**
 * @method $this withDate(string $date)
 * @method $this withCompanyId(int $companyId)
 * @method $this withCheckNumber(string $checkNumber)
 * @method $this withCurrencyIso4217Code(SystemCurrencies $currencyIso4217Code)
 * @method $this withExchangeRate(string $exchangeRate)
 * @method $this withMemo(string $memo)
 * @method $this withCustomFields(?array $customFields)
 * @method $this withClassifications(?array $classifications)
 * @method $this withTransactionIds(?array $transactionIds)
 * @method $this withBankMatchStatus(?string $bankMatchStatus)
 * @method $this withReconciliationStatus(?string $reconciliationStatus)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withInternalId(?int $internalId)
 * @method $this withNumber(?int $number)
 * @method $this withCode(?string $code)
 * @method $this withAccountNumber(?int $accountNumber)
 * @method $this withItems(?array $items)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCompanyCurrency(?string $companyCurrency)
 * @method $this withCustomerId(?int $customerId)
 * @method $this withCustomerName(?string $customerName)
 * @method $this withTransactionDate(?string $transactionDate)
 * @method $this withUndepositedFundsCurrency(?SystemCurrencies $undepositedFundsCurrency)
 * @method $this withBankOrUndepositedAccountAmount(?string $bankOrUndepositedAccountAmount)
 * @method $this withAmount(?string $amount)
 * @method $this withUnassignedAmount(?string $unassignedAmount)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withCustomerDeposits(?array $customerDeposits)
 * @method $this withPaymentMethodId(?int $paymentMethodId)
 * @method $this withPaperCheckStatus(?PaperCheckRecordStatus $paperCheckStatus)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withLineDateValidation(?bool $lineDateValidation)
 */
final class CustomerPayment
{
    use ImmutableAttributes;

    private function __construct(
        public readonly string $date,
        public readonly int $companyId,
        public readonly string $checkNumber,
        public readonly SystemCurrencies $currencyIso4217Code,
        public readonly string $exchangeRate,
        public readonly string $memo,
        public readonly ?array $customFields = null,
        /** @var array<int, RecordClassification> */
        public readonly ?array $classifications = null,
        public readonly ?array $transactionIds = null,
        public readonly ?string $bankMatchStatus = null,
        public readonly ?string $reconciliationStatus = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?int $internalId = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        public readonly ?int $accountNumber = null,
        /** @var array<int, CustomerPaymentLineItem> */
        public readonly ?array $items = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?int $customerId = null,
        public readonly ?string $customerName = null,
        public readonly ?string $transactionDate = null,
        public readonly ?SystemCurrencies $undepositedFundsCurrency = null,
        public readonly ?string $bankOrUndepositedAccountAmount = null,
        public readonly ?string $amount = null,
        public readonly ?string $unassignedAmount = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?array $customerDeposits = null,
        public readonly ?int $paymentMethodId = null,
        public readonly ?PaperCheckRecordStatus $paperCheckStatus = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?bool $lineDateValidation = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created CustomerPayment ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $date,
        int $companyId,
        string $checkNumber,
        SystemCurrencies $currencyIso4217Code,
        string $exchangeRate,
        string $memo,
        ?array $customFields = null,
        ?int $accountNumber = null,
        /** @var array<int, CustomerPaymentLineItem> */
        ?array $items = null,
        ?int $customerId = null,
        ?string $transactionDate = null,
        ?SystemCurrencies $undepositedFundsCurrency = null,
        ?string $unassignedAmount = null,
        ?RecordStatus $recordStatus = null,
        ?int $paymentMethodId = null,
        ?bool $lineDateValidation = null,
    ): self {
        return new self(
            date: $date,
            companyId: $companyId,
            checkNumber: $checkNumber,
            currencyIso4217Code: $currencyIso4217Code,
            exchangeRate: $exchangeRate,
            memo: $memo,
            customFields: $customFields,
            classifications: null,
            transactionIds: null,
            bankMatchStatus: null,
            reconciliationStatus: null,
            createdBy: null,
            updatedBy: null,
            internalId: null,
            number: null,
            code: null,
            accountNumber: $accountNumber,
            items: $items,
            companyName: null,
            companyCurrency: null,
            customerId: $customerId,
            customerName: null,
            transactionDate: $transactionDate,
            undepositedFundsCurrency: $undepositedFundsCurrency,
            bankOrUndepositedAccountAmount: null,
            amount: null,
            unassignedAmount: $unassignedAmount,
            recordStatus: $recordStatus,
            customerDeposits: null,
            paymentMethodId: $paymentMethodId,
            paperCheckStatus: null,
            createdAt: null,
            updatedAt: null,
            lineDateValidation: $lineDateValidation,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            date: $data['date'],
            companyId: $data['company_id'],
            checkNumber: $data['check_number'],
            currencyIso4217Code: SystemCurrencies::fromWire($data['currency_iso_4217_code']),
            exchangeRate: $data['exchange_rate'],
            memo: $data['memo'],
            customFields: $data['custom_fields'] ?? null,
            classifications: array_map(static fn (array $row): RecordClassification => RecordClassification::fromWire($row), $data['classifications'] ?? []),
            transactionIds: $data['transaction_ids'] ?? null,
            bankMatchStatus: $data['bank_match_status'] ?? null,
            reconciliationStatus: $data['reconciliation_status'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            internalId: $data['internal_id'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            accountNumber: $data['account_number'] ?? null,
            items: array_map(static fn (array $row): CustomerPaymentLineItem => CustomerPaymentLineItem::fromWire($row), $data['items'] ?? []),
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            customerId: $data['customer_id'] ?? null,
            customerName: $data['customer_name'] ?? null,
            transactionDate: $data['transaction_date'] ?? null,
            undepositedFundsCurrency: isset($data['undeposited_funds_currency']) ? SystemCurrencies::fromWire($data['undeposited_funds_currency']) : null,
            bankOrUndepositedAccountAmount: $data['bank_or_undeposited_account_amount'] ?? null,
            amount: $data['amount'] ?? null,
            unassignedAmount: $data['unassigned_amount'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            customerDeposits: $data['customer_deposits'] ?? null,
            paymentMethodId: $data['payment_method_id'] ?? null,
            paperCheckStatus: isset($data['paper_check_status']) ? PaperCheckRecordStatus::fromWire($data['paper_check_status']) : null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            lineDateValidation: $data['line_date_validation'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'date' => $this->date,
            'company_id' => $this->companyId,
            'check_number' => $this->checkNumber,
            'currency_iso_4217_code' => $this->currencyIso4217Code->toWire(),
            'exchange_rate' => $this->exchangeRate,
            'memo' => $this->memo,
            'custom_fields' => $this->customFields,
            'account_number' => $this->accountNumber,
            'items' => array_map(static fn (CustomerPaymentLineItem $row): array => $row->toWire(), $this->items),
            'customer_id' => $this->customerId,
            'transaction_date' => $this->transactionDate,
            'undeposited_funds_currency' => $this->undepositedFundsCurrency?->toWire(),
            'unassigned_amount' => $this->unassignedAmount,
            'record_status' => $this->recordStatus?->toWire(),
            'payment_method_id' => $this->paymentMethodId,
            'line_date_validation' => $this->lineDateValidation,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
