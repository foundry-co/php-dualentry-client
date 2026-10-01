<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Address;
use FoundryCo\DualEntry\ValueObjects\Attachment;
use FoundryCo\DualEntry\ValueObjects\Enums\BillingCadence;
use FoundryCo\DualEntry\ValueObjects\Enums\ContractStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\RecognitionCadence;
use FoundryCo\DualEntry\ValueObjects\Enums\RecognitionMode;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;

/**
 * @method $this withStatus(ContractStatus $status)
 * @method $this withCustomFields(?array $customFields)
 * @method $this withCompletedApprovalsCount(?int $completedApprovalsCount)
 * @method $this withTotalApprovalsCount(?int $totalApprovalsCount)
 * @method $this withIntegrationRemoteRecords(?array $integrationRemoteRecords)
 * @method $this withId(?int $id)
 * @method $this withNumber(?int $number)
 * @method $this withCode(?string $code)
 * @method $this withCompanyId(?int $companyId)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCompanyCurrency(?SystemCurrencies $companyCurrency)
 * @method $this withCustomerId(?int $customerId)
 * @method $this withCustomerName(?string $customerName)
 * @method $this withName(?string $name)
 * @method $this withCurrencyIso4217Code(?SystemCurrencies $currencyIso4217Code)
 * @method $this withMemo(?string $memo)
 * @method $this withDate(?string $date)
 * @method $this withTermId(?int $termId)
 * @method $this withDefaultArAccountId(?int $defaultArAccountId)
 * @method $this withContractTemplateId(?int $contractTemplateId)
 * @method $this withStartDate(?string $startDate)
 * @method $this withEndDate(?string $endDate)
 * @method $this withBillToAddress(?string $billToAddress)
 * @method $this withShipToAddress(?string $shipToAddress)
 * @method $this withBillingAddress(?Address $billingAddress)
 * @method $this withShippingAddress(?Address $shippingAddress)
 * @method $this withBillingAnchorWeekday(?int $billingAnchorWeekday)
 * @method $this withRecognitionAnchorWeekday(?int $recognitionAnchorWeekday)
 * @method $this withIsIncomplete(?bool $isIncomplete)
 * @method $this withCutoverDate(?string $cutoverDate)
 * @method $this withPriorRecognizedAmount(?string $priorRecognizedAmount)
 * @method $this withDefaultEarlyTerminationFee(?string $defaultEarlyTerminationFee)
 * @method $this withRecognitionMode(?RecognitionMode $recognitionMode)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withIsLocked(?bool $isLocked)
 * @method $this withWorkflowStatus(?string $workflowStatus)
 * @method $this withPendingApproversCount(?int $pendingApproversCount)
 * @method $this withPayment(?array $payment)
 * @method $this withRevenueRecognitions(?array $revenueRecognitions)
 * @method $this withInvoices(?array $invoices)
 * @method $this withObligations(?array $obligations)
 * @method $this withObligationUsage(?array $obligationUsage)
 * @method $this withAmount(?string $amount)
 * @method $this withRenewedEndDate(?string $renewedEndDate)
 * @method $this withNextRenewalDate(?string $nextRenewalDate)
 * @method $this withDaysTillExpiry(?int $daysTillExpiry)
 * @method $this withTermination(?array $termination)
 * @method $this withChangeOrders(?array $changeOrders)
 * @method $this withCustomerCredits(?array $customerCredits)
 * @method $this withCachedMetrics(?array $cachedMetrics)
 * @method $this withHasUsageObligations(?bool $hasUsageObligations)
 * @method $this withHasUsages(?bool $hasUsages)
 * @method $this withApprovalInfo(?array $approvalInfo)
 * @method $this withApprovalChain(?array $approvalChain)
 * @method $this withBankMatchStatus(?string $bankMatchStatus)
 * @method $this withContractAttachments(?array $contractAttachments)
 * @method $this withChangeOrdersAttachments(?array $changeOrdersAttachments)
 * @method $this withMetrics(?array $metrics)
 * @method $this withBillingStartDate(?string $billingStartDate)
 * @method $this withBillingFrequency(?BillingCadence $billingFrequency)
 * @method $this withBillingInterval(?int $billingInterval)
 * @method $this withRecognitionStartDate(?string $recognitionStartDate)
 * @method $this withRecognitionFrequency(?RecognitionCadence $recognitionFrequency)
 * @method $this withRecognitionInterval(?int $recognitionInterval)
 * @method $this withPreparedInvoices(?array $preparedInvoices)
 * @method $this withBookIds(?array $bookIds)
 */
final class Contract
{
    use ImmutableAttributes;

    private function __construct(
        public readonly ContractStatus $status,
        public readonly ?array $customFields = null,
        public readonly ?int $completedApprovalsCount = null,
        public readonly ?int $totalApprovalsCount = null,
        public readonly ?array $integrationRemoteRecords = null,
        public readonly ?int $id = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        public readonly ?int $companyId = null,
        public readonly ?string $companyName = null,
        public readonly ?SystemCurrencies $companyCurrency = null,
        public readonly ?int $customerId = null,
        public readonly ?string $customerName = null,
        public readonly ?string $name = null,
        public readonly ?SystemCurrencies $currencyIso4217Code = null,
        public readonly ?string $memo = null,
        public readonly ?string $date = null,
        public readonly ?int $termId = null,
        public readonly ?int $defaultArAccountId = null,
        public readonly ?int $contractTemplateId = null,
        public readonly ?string $startDate = null,
        public readonly ?string $endDate = null,
        public readonly ?string $billToAddress = null,
        public readonly ?string $shipToAddress = null,
        public readonly ?Address $billingAddress = null,
        public readonly ?Address $shippingAddress = null,
        public readonly ?int $billingAnchorWeekday = null,
        public readonly ?int $recognitionAnchorWeekday = null,
        public readonly ?bool $isIncomplete = null,
        public readonly ?string $cutoverDate = null,
        public readonly ?string $priorRecognizedAmount = null,
        public readonly ?string $defaultEarlyTerminationFee = null,
        public readonly ?RecognitionMode $recognitionMode = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?bool $isLocked = null,
        public readonly ?string $workflowStatus = null,
        public readonly ?int $pendingApproversCount = null,
        public readonly ?array $payment = null,
        public readonly ?array $revenueRecognitions = null,
        public readonly ?array $invoices = null,
        public readonly ?array $obligations = null,
        public readonly ?array $obligationUsage = null,
        public readonly ?string $amount = null,
        public readonly ?string $renewedEndDate = null,
        public readonly ?string $nextRenewalDate = null,
        public readonly ?int $daysTillExpiry = null,
        public readonly ?array $termination = null,
        public readonly ?array $changeOrders = null,
        public readonly ?array $customerCredits = null,
        public readonly ?array $cachedMetrics = null,
        public readonly ?bool $hasUsageObligations = null,
        public readonly ?bool $hasUsages = null,
        public readonly ?array $approvalInfo = null,
        public readonly ?array $approvalChain = null,
        public readonly ?string $bankMatchStatus = null,
        /** @var array<int, Attachment> */
        public readonly ?array $contractAttachments = null,
        /** @var array<int, Attachment> */
        public readonly ?array $changeOrdersAttachments = null,
        public readonly ?array $metrics = null,
        public readonly ?string $billingStartDate = null,
        public readonly ?BillingCadence $billingFrequency = null,
        public readonly ?int $billingInterval = null,
        public readonly ?string $recognitionStartDate = null,
        public readonly ?RecognitionCadence $recognitionFrequency = null,
        public readonly ?int $recognitionInterval = null,
        public readonly ?array $preparedInvoices = null,
        public readonly ?array $bookIds = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created Contract ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        ContractStatus $status,
        ?array $customFields = null,
        ?int $companyId = null,
        ?int $customerId = null,
        ?string $name = null,
        ?SystemCurrencies $currencyIso4217Code = null,
        ?string $memo = null,
        ?string $date = null,
        ?int $termId = null,
        ?int $defaultArAccountId = null,
        ?int $contractTemplateId = null,
        ?string $startDate = null,
        ?string $endDate = null,
        ?string $billToAddress = null,
        ?string $shipToAddress = null,
        ?Address $billingAddress = null,
        ?Address $shippingAddress = null,
        ?int $billingAnchorWeekday = null,
        ?int $recognitionAnchorWeekday = null,
        ?string $cutoverDate = null,
        ?string $priorRecognizedAmount = null,
        ?string $defaultEarlyTerminationFee = null,
        ?RecognitionMode $recognitionMode = null,
        ?array $payment = null,
        ?array $revenueRecognitions = null,
        ?array $obligations = null,
        /** @var array<int, Attachment> */
        ?array $contractAttachments = null,
        /** @var array<int, Attachment> */
        ?array $changeOrdersAttachments = null,
        ?string $billingStartDate = null,
        ?BillingCadence $billingFrequency = null,
        ?int $billingInterval = null,
        ?string $recognitionStartDate = null,
        ?RecognitionCadence $recognitionFrequency = null,
        ?int $recognitionInterval = null,
        ?array $preparedInvoices = null,
        ?array $bookIds = null,
    ): self {
        return new self(
            status: $status,
            customFields: $customFields,
            completedApprovalsCount: null,
            totalApprovalsCount: null,
            integrationRemoteRecords: null,
            id: null,
            number: null,
            code: null,
            companyId: $companyId,
            companyName: null,
            companyCurrency: null,
            customerId: $customerId,
            customerName: null,
            name: $name,
            currencyIso4217Code: $currencyIso4217Code,
            memo: $memo,
            date: $date,
            termId: $termId,
            defaultArAccountId: $defaultArAccountId,
            contractTemplateId: $contractTemplateId,
            startDate: $startDate,
            endDate: $endDate,
            billToAddress: $billToAddress,
            shipToAddress: $shipToAddress,
            billingAddress: $billingAddress,
            shippingAddress: $shippingAddress,
            billingAnchorWeekday: $billingAnchorWeekday,
            recognitionAnchorWeekday: $recognitionAnchorWeekday,
            isIncomplete: null,
            cutoverDate: $cutoverDate,
            priorRecognizedAmount: $priorRecognizedAmount,
            defaultEarlyTerminationFee: $defaultEarlyTerminationFee,
            recognitionMode: $recognitionMode,
            recordStatus: null,
            isLocked: null,
            workflowStatus: null,
            pendingApproversCount: null,
            payment: $payment,
            revenueRecognitions: $revenueRecognitions,
            invoices: null,
            obligations: $obligations,
            obligationUsage: null,
            amount: null,
            renewedEndDate: null,
            nextRenewalDate: null,
            daysTillExpiry: null,
            termination: null,
            changeOrders: null,
            customerCredits: null,
            cachedMetrics: null,
            hasUsageObligations: null,
            hasUsages: null,
            approvalInfo: null,
            approvalChain: null,
            bankMatchStatus: null,
            contractAttachments: $contractAttachments,
            changeOrdersAttachments: $changeOrdersAttachments,
            metrics: null,
            billingStartDate: $billingStartDate,
            billingFrequency: $billingFrequency,
            billingInterval: $billingInterval,
            recognitionStartDate: $recognitionStartDate,
            recognitionFrequency: $recognitionFrequency,
            recognitionInterval: $recognitionInterval,
            preparedInvoices: $preparedInvoices,
            bookIds: $bookIds,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            status: ContractStatus::fromWire($data['status']),
            customFields: $data['custom_fields'] ?? null,
            completedApprovalsCount: $data['completed_approvals_count'] ?? null,
            totalApprovalsCount: $data['total_approvals_count'] ?? null,
            integrationRemoteRecords: $data['integration_remote_records'] ?? null,
            id: $data['id'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            companyId: $data['company_id'] ?? null,
            companyName: $data['company_name'] ?? null,
            companyCurrency: isset($data['company_currency']) ? SystemCurrencies::fromWire($data['company_currency']) : null,
            customerId: $data['customer_id'] ?? null,
            customerName: $data['customer_name'] ?? null,
            name: $data['name'] ?? null,
            currencyIso4217Code: isset($data['currency_iso_4217_code']) ? SystemCurrencies::fromWire($data['currency_iso_4217_code']) : null,
            memo: $data['memo'] ?? null,
            date: $data['date'] ?? null,
            termId: $data['term_id'] ?? null,
            defaultArAccountId: $data['default_ar_account_id'] ?? null,
            contractTemplateId: $data['contract_template_id'] ?? null,
            startDate: $data['start_date'] ?? null,
            endDate: $data['end_date'] ?? null,
            billToAddress: $data['bill_to_address'] ?? null,
            shipToAddress: $data['ship_to_address'] ?? null,
            billingAddress: isset($data['billing_address']) ? Address::fromWire($data['billing_address']) : null,
            shippingAddress: isset($data['shipping_address']) ? Address::fromWire($data['shipping_address']) : null,
            billingAnchorWeekday: $data['billing_anchor_weekday'] ?? null,
            recognitionAnchorWeekday: $data['recognition_anchor_weekday'] ?? null,
            isIncomplete: $data['is_incomplete'] ?? null,
            cutoverDate: $data['cutover_date'] ?? null,
            priorRecognizedAmount: $data['prior_recognized_amount'] ?? null,
            defaultEarlyTerminationFee: $data['default_early_termination_fee'] ?? null,
            recognitionMode: isset($data['recognition_mode']) ? RecognitionMode::fromWire($data['recognition_mode']) : null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            isLocked: $data['is_locked'] ?? null,
            workflowStatus: $data['workflow_status'] ?? null,
            pendingApproversCount: $data['pending_approvers_count'] ?? null,
            payment: $data['payment'] ?? null,
            revenueRecognitions: $data['revenue_recognitions'] ?? null,
            invoices: $data['invoices'] ?? null,
            obligations: $data['obligations'] ?? null,
            obligationUsage: $data['obligation_usage'] ?? null,
            amount: $data['amount'] ?? null,
            renewedEndDate: $data['renewed_end_date'] ?? null,
            nextRenewalDate: $data['next_renewal_date'] ?? null,
            daysTillExpiry: $data['days_till_expiry'] ?? null,
            termination: $data['termination'] ?? null,
            changeOrders: $data['change_orders'] ?? null,
            customerCredits: $data['customer_credits'] ?? null,
            cachedMetrics: $data['cached_metrics'] ?? null,
            hasUsageObligations: $data['has_usage_obligations'] ?? null,
            hasUsages: $data['has_usages'] ?? null,
            approvalInfo: $data['approval_info'] ?? null,
            approvalChain: $data['approval_chain'] ?? null,
            bankMatchStatus: $data['bank_match_status'] ?? null,
            contractAttachments: array_map(static fn (array $row): Attachment => Attachment::fromWire($row), $data['contract_attachments'] ?? []),
            changeOrdersAttachments: array_map(static fn (array $row): Attachment => Attachment::fromWire($row), $data['change_orders_attachments'] ?? []),
            metrics: $data['metrics'] ?? null,
            billingStartDate: $data['billing_start_date'] ?? null,
            billingFrequency: isset($data['billing_frequency']) ? BillingCadence::fromWire($data['billing_frequency']) : null,
            billingInterval: $data['billing_interval'] ?? null,
            recognitionStartDate: $data['recognition_start_date'] ?? null,
            recognitionFrequency: isset($data['recognition_frequency']) ? RecognitionCadence::fromWire($data['recognition_frequency']) : null,
            recognitionInterval: $data['recognition_interval'] ?? null,
            preparedInvoices: $data['prepared_invoices'] ?? null,
            bookIds: $data['book_ids'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'status' => $this->status->toWire(),
            'custom_fields' => $this->customFields,
            'company_id' => $this->companyId,
            'customer_id' => $this->customerId,
            'name' => $this->name,
            'currency_iso_4217_code' => $this->currencyIso4217Code?->toWire(),
            'memo' => $this->memo,
            'date' => $this->date,
            'term_id' => $this->termId,
            'default_ar_account_id' => $this->defaultArAccountId,
            'contract_template_id' => $this->contractTemplateId,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'bill_to_address' => $this->billToAddress,
            'ship_to_address' => $this->shipToAddress,
            'billing_address' => $this->billingAddress?->toWire(),
            'shipping_address' => $this->shippingAddress?->toWire(),
            'billing_anchor_weekday' => $this->billingAnchorWeekday,
            'recognition_anchor_weekday' => $this->recognitionAnchorWeekday,
            'cutover_date' => $this->cutoverDate,
            'prior_recognized_amount' => $this->priorRecognizedAmount,
            'default_early_termination_fee' => $this->defaultEarlyTerminationFee,
            'recognition_mode' => $this->recognitionMode?->toWire(),
            'payment' => $this->payment,
            'revenue_recognitions' => $this->revenueRecognitions,
            'obligations' => $this->obligations,
            'contract_attachments' => array_map(static fn (Attachment $row): array => $row->toWire(), $this->contractAttachments),
            'change_orders_attachments' => array_map(static fn (Attachment $row): array => $row->toWire(), $this->changeOrdersAttachments),
            'billing_start_date' => $this->billingStartDate,
            'billing_frequency' => $this->billingFrequency?->toWire(),
            'billing_interval' => $this->billingInterval,
            'recognition_start_date' => $this->recognitionStartDate,
            'recognition_frequency' => $this->recognitionFrequency?->toWire(),
            'recognition_interval' => $this->recognitionInterval,
            'prepared_invoices' => $this->preparedInvoices,
            'book_ids' => $this->bookIds,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
