<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Address;
use FoundryCo\DualEntry\ValueObjects\Enums\QuoteContractEndType;
use FoundryCo\DualEntry\ValueObjects\Enums\QuoteHeadlineTotal;
use FoundryCo\DualEntry\ValueObjects\Enums\QuoteSendStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;

/**
 * @method $this withCompanyId(int $companyId)
 * @method $this withEmail(string $email)
 * @method $this withCurrencyIso4217Code(string $currencyIso4217Code)
 * @method $this withCloseDate(string $closeDate)
 * @method $this withContractStartDate(string $contractStartDate)
 * @method $this withBillToAddress(?string $billToAddress)
 * @method $this withShipToAddress(?string $shipToAddress)
 * @method $this withBillingAddress(?Address $billingAddress)
 * @method $this withShippingAddress(?Address $shippingAddress)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withCompletedApprovalsCount(?int $completedApprovalsCount)
 * @method $this withTotalApprovalsCount(?int $totalApprovalsCount)
 * @method $this withWorkflowStatus(?string $workflowStatus)
 * @method $this withPendingApproversCount(?int $pendingApproversCount)
 * @method $this withSendStatus(?QuoteSendStatus $sendStatus)
 * @method $this withCanSend(?bool $canSend)
 * @method $this withApprovalInfo(?array $approvalInfo)
 * @method $this withApprovalChain(?array $approvalChain)
 * @method $this withBankMatchStatus(?string $bankMatchStatus)
 * @method $this withId(?int $id)
 * @method $this withNumber(?int $number)
 * @method $this withCode(?string $code)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withValidUntil(?string $validUntil)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCompanyCurrency(?string $companyCurrency)
 * @method $this withCustomerId(?int $customerId)
 * @method $this withCustomerName(?string $customerName)
 * @method $this withName(?string $name)
 * @method $this withTermId(?int $termId)
 * @method $this withTermName(?string $termName)
 * @method $this withMemo(?string $memo)
 * @method $this withContractEndType(?QuoteContractEndType $contractEndType)
 * @method $this withNumberOfMonths(?int $numberOfMonths)
 * @method $this withContractEndDate(?string $contractEndDate)
 * @method $this withContractLegalTerms(?string $contractLegalTerms)
 * @method $this withSentAt(?string $sentAt)
 * @method $this withDocumentHeadlineTotal(?QuoteHeadlineTotal $documentHeadlineTotal)
 * @method $this withDocumentTotalRows(?array $documentTotalRows)
 * @method $this withDocumentYearByYear(?bool $documentYearByYear)
 * @method $this withItems(?array $items)
 * @method $this withRecipients(?array $recipients)
 * @method $this withSubtotal(?string $subtotal)
 * @method $this withDiscountTotal(?string $discountTotal)
 * @method $this withTaxTotal(?string $taxTotal)
 * @method $this withAmount(?string $amount)
 * @method $this withContractValue(?string $contractValue)
 * @method $this withTotals(?array $totals)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 */
final class Quote
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly int $companyId,
        public readonly string $email,
        public readonly string $currencyIso4217Code,
        public readonly string $closeDate,
        public readonly string $contractStartDate,
        public readonly ?string $billToAddress = null,
        public readonly ?string $shipToAddress = null,
        public readonly ?Address $billingAddress = null,
        public readonly ?Address $shippingAddress = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?int $completedApprovalsCount = null,
        public readonly ?int $totalApprovalsCount = null,
        public readonly ?string $workflowStatus = null,
        public readonly ?int $pendingApproversCount = null,
        public readonly ?QuoteSendStatus $sendStatus = null,
        public readonly ?bool $canSend = null,
        public readonly ?array $approvalInfo = null,
        public readonly ?array $approvalChain = null,
        public readonly ?string $bankMatchStatus = null,
        public readonly ?int $id = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?string $validUntil = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?int $customerId = null,
        public readonly ?string $customerName = null,
        public readonly ?string $name = null,
        public readonly ?int $termId = null,
        public readonly ?string $termName = null,
        public readonly ?string $memo = null,
        public readonly ?QuoteContractEndType $contractEndType = null,
        public readonly ?int $numberOfMonths = null,
        public readonly ?string $contractEndDate = null,
        public readonly ?string $contractLegalTerms = null,
        public readonly ?string $sentAt = null,
        public readonly ?QuoteHeadlineTotal $documentHeadlineTotal = null,
        public readonly ?array $documentTotalRows = null,
        public readonly ?bool $documentYearByYear = null,
        public readonly ?array $items = null,
        public readonly ?array $recipients = null,
        public readonly ?string $subtotal = null,
        public readonly ?string $discountTotal = null,
        public readonly ?string $taxTotal = null,
        public readonly ?string $amount = null,
        public readonly ?string $contractValue = null,
        public readonly ?array $totals = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created Quote ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        int $companyId,
        string $email,
        string $currencyIso4217Code,
        string $closeDate,
        string $contractStartDate,
        ?string $billToAddress = null,
        ?string $shipToAddress = null,
        ?Address $billingAddress = null,
        ?Address $shippingAddress = null,
        ?RecordStatus $recordStatus = null,
        ?string $validUntil = null,
        ?int $customerId = null,
        ?string $name = null,
        ?int $termId = null,
        ?string $memo = null,
        ?QuoteContractEndType $contractEndType = null,
        ?int $numberOfMonths = null,
        ?string $contractEndDate = null,
        ?string $contractLegalTerms = null,
        ?QuoteHeadlineTotal $documentHeadlineTotal = null,
        ?array $documentTotalRows = null,
        ?bool $documentYearByYear = null,
        ?array $items = null,
        ?array $recipients = null,
    ): self {
        return new self(
            companyId: $companyId,
            email: $email,
            currencyIso4217Code: $currencyIso4217Code,
            closeDate: $closeDate,
            contractStartDate: $contractStartDate,
            billToAddress: $billToAddress,
            shipToAddress: $shipToAddress,
            billingAddress: $billingAddress,
            shippingAddress: $shippingAddress,
            createdAt: null,
            updatedAt: null,
            completedApprovalsCount: null,
            totalApprovalsCount: null,
            workflowStatus: null,
            pendingApproversCount: null,
            sendStatus: null,
            canSend: null,
            approvalInfo: null,
            approvalChain: null,
            bankMatchStatus: null,
            id: null,
            number: null,
            code: null,
            recordStatus: $recordStatus,
            validUntil: $validUntil,
            companyName: null,
            companyCurrency: null,
            customerId: $customerId,
            customerName: null,
            name: $name,
            termId: $termId,
            termName: null,
            memo: $memo,
            contractEndType: $contractEndType,
            numberOfMonths: $numberOfMonths,
            contractEndDate: $contractEndDate,
            contractLegalTerms: $contractLegalTerms,
            sentAt: null,
            documentHeadlineTotal: $documentHeadlineTotal,
            documentTotalRows: $documentTotalRows,
            documentYearByYear: $documentYearByYear,
            items: $items,
            recipients: $recipients,
            subtotal: null,
            discountTotal: null,
            taxTotal: null,
            amount: null,
            contractValue: null,
            totals: null,
            createdBy: null,
            updatedBy: null,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            companyId: $data['company_id'],
            email: $data['email'],
            currencyIso4217Code: $data['currency_iso_4217_code'],
            closeDate: $data['close_date'],
            contractStartDate: $data['contract_start_date'],
            billToAddress: $data['bill_to_address'] ?? null,
            shipToAddress: $data['ship_to_address'] ?? null,
            billingAddress: isset($data['billing_address']) ? Address::fromWire($data['billing_address']) : null,
            shippingAddress: isset($data['shipping_address']) ? Address::fromWire($data['shipping_address']) : null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            completedApprovalsCount: $data['completed_approvals_count'] ?? null,
            totalApprovalsCount: $data['total_approvals_count'] ?? null,
            workflowStatus: $data['workflow_status'] ?? null,
            pendingApproversCount: $data['pending_approvers_count'] ?? null,
            sendStatus: isset($data['send_status']) ? QuoteSendStatus::fromWire($data['send_status']) : null,
            canSend: $data['can_send'] ?? null,
            approvalInfo: $data['approval_info'] ?? null,
            approvalChain: $data['approval_chain'] ?? null,
            bankMatchStatus: $data['bank_match_status'] ?? null,
            id: $data['id'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            validUntil: $data['valid_until'] ?? null,
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            customerId: $data['customer_id'] ?? null,
            customerName: $data['customer_name'] ?? null,
            name: $data['name'] ?? null,
            termId: $data['term_id'] ?? null,
            termName: $data['term_name'] ?? null,
            memo: $data['memo'] ?? null,
            contractEndType: isset($data['contract_end_type']) ? QuoteContractEndType::fromWire($data['contract_end_type']) : null,
            numberOfMonths: $data['number_of_months'] ?? null,
            contractEndDate: $data['contract_end_date'] ?? null,
            contractLegalTerms: $data['contract_legal_terms'] ?? null,
            sentAt: $data['sent_at'] ?? null,
            documentHeadlineTotal: isset($data['document_headline_total']) ? QuoteHeadlineTotal::fromWire($data['document_headline_total']) : null,
            documentTotalRows: $data['document_total_rows'] ?? null,
            documentYearByYear: $data['document_year_by_year'] ?? null,
            items: $data['items'] ?? null,
            recipients: $data['recipients'] ?? null,
            subtotal: $data['subtotal'] ?? null,
            discountTotal: $data['discount_total'] ?? null,
            taxTotal: $data['tax_total'] ?? null,
            amount: $data['amount'] ?? null,
            contractValue: $data['contract_value'] ?? null,
            totals: $data['totals'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'company_id' => $this->companyId,
            'email' => $this->email,
            'currency_iso_4217_code' => $this->currencyIso4217Code,
            'close_date' => $this->closeDate,
            'contract_start_date' => $this->contractStartDate,
            'bill_to_address' => $this->billToAddress,
            'ship_to_address' => $this->shipToAddress,
            'billing_address' => $this->billingAddress?->toWire(),
            'shipping_address' => $this->shippingAddress?->toWire(),
            'record_status' => $this->recordStatus?->toWire(),
            'valid_until' => $this->validUntil,
            'customer_id' => $this->customerId,
            'name' => $this->name,
            'term_id' => $this->termId,
            'memo' => $this->memo,
            'contract_end_type' => $this->contractEndType?->toWire(),
            'number_of_months' => $this->numberOfMonths,
            'contract_end_date' => $this->contractEndDate,
            'contract_legal_terms' => $this->contractLegalTerms,
            'document_headline_total' => $this->documentHeadlineTotal?->toWire(),
            'document_total_rows' => $this->documentTotalRows,
            'document_year_by_year' => $this->documentYearByYear,
            'items' => $this->items,
            'recipients' => $this->recipients,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
