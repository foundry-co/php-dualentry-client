<?php

namespace FoundryCo\DualEntry;

use FoundryCo\DualEntry\Resources\AccountBalanceResource;
use FoundryCo\DualEntry\Resources\AccountResource;
use FoundryCo\DualEntry\Resources\BankConnectionResource;
use FoundryCo\DualEntry\Resources\BankMatchResource;
use FoundryCo\DualEntry\Resources\BankTransferResource;
use FoundryCo\DualEntry\Resources\BillResource;
use FoundryCo\DualEntry\Resources\BudgetResource;
use FoundryCo\DualEntry\Resources\CashSaleResource;
use FoundryCo\DualEntry\Resources\ClassificationLineResource;
use FoundryCo\DualEntry\Resources\ClassificationResource;
use FoundryCo\DualEntry\Resources\CompanyResource;
use FoundryCo\DualEntry\Resources\ContractResource;
use FoundryCo\DualEntry\Resources\CustomerCreditResource;
use FoundryCo\DualEntry\Resources\CustomerDepositResource;
use FoundryCo\DualEntry\Resources\CustomerPaymentResource;
use FoundryCo\DualEntry\Resources\CustomerPrepaymentApplicationResource;
use FoundryCo\DualEntry\Resources\CustomerPrepaymentResource;
use FoundryCo\DualEntry\Resources\CustomerRefundResource;
use FoundryCo\DualEntry\Resources\CustomerResource;
use FoundryCo\DualEntry\Resources\CustomFieldResource;
use FoundryCo\DualEntry\Resources\DepreciationBookResource;
use FoundryCo\DualEntry\Resources\DirectExpenseResource;
use FoundryCo\DualEntry\Resources\ExchangeRateResource;
use FoundryCo\DualEntry\Resources\ExportJobResource;
use FoundryCo\DualEntry\Resources\FixedAssetClassResource;
use FoundryCo\DualEntry\Resources\FixedAssetResource;
use FoundryCo\DualEntry\Resources\GstTaxRateResource;
use FoundryCo\DualEntry\Resources\HealthResource;
use FoundryCo\DualEntry\Resources\InboxResource;
use FoundryCo\DualEntry\Resources\IntercompanyJournalEntryResource;
use FoundryCo\DualEntry\Resources\InvoiceResource;
use FoundryCo\DualEntry\Resources\ItemResource;
use FoundryCo\DualEntry\Resources\JournalEntryResource;
use FoundryCo\DualEntry\Resources\OAuthResource;
use FoundryCo\DualEntry\Resources\PaperCheckResource;
use FoundryCo\DualEntry\Resources\ProductTaxCodeResource;
use FoundryCo\DualEntry\Resources\PurchaseOrderResource;
use FoundryCo\DualEntry\Resources\QuoteResource;
use FoundryCo\DualEntry\Resources\RecurringBillResource;
use FoundryCo\DualEntry\Resources\RecurringInvoiceResource;
use FoundryCo\DualEntry\Resources\RecurringJournalEntryResource;
use FoundryCo\DualEntry\Resources\SalesOrderResource;
use FoundryCo\DualEntry\Resources\StatisticalJournalResource;
use FoundryCo\DualEntry\Resources\TaxResource;
use FoundryCo\DualEntry\Resources\VatRateResource;
use FoundryCo\DualEntry\Resources\VendorCreditResource;
use FoundryCo\DualEntry\Resources\VendorPaymentResource;
use FoundryCo\DualEntry\Resources\VendorPrepaymentApplicationResource;
use FoundryCo\DualEntry\Resources\VendorPrepaymentResource;
use FoundryCo\DualEntry\Resources\VendorRefundResource;
use FoundryCo\DualEntry\Resources\VendorResource;
use FoundryCo\DualEntry\Resources\WebhookResource;
use FoundryCo\DualEntry\Resources\WorkflowResource;
use FoundryCo\DualEntry\Support\RateLimitInfo;
use FoundryCo\DualEntry\Transport\GuzzleTransport;
use FoundryCo\DualEntry\Transport\Transport;

/**
 * Entry point for the DualEntry public API.
 *
 * @see https://docs.dualentry.com/developers/guides/api
 */
final class DualEntryClient
{
    /** @var array<class-string, object> */
    private array $resources = [];

    public function __construct(private readonly Transport $transport) {}

    /**
     *     base_uri?: string,
     *     timeout?: float,
     *     max_retries?: int,
     *     auto_idempotency_keys?: bool,
     *     guzzle?: array<string, mixed>,
     * } $options
     */
    public static function make(string $apiKey, array $options = []): self
    {
        return new self(GuzzleTransport::make(
            apiKey: $apiKey,
            baseUri: $options['base_uri'] ?? GuzzleTransport::PRODUCTION_BASE_URI,
            timeout: $options['timeout'] ?? 30.0,
            maxRetries: $options['max_retries'] ?? 2,
            autoIdempotencyKeys: $options['auto_idempotency_keys'] ?? true,
            guzzleOptions: $options['guzzle'] ?? [],
        ));
    }

    public function getTransport(): Transport
    {
        return $this->transport;
    }

    public function getLastRateLimit(): ?RateLimitInfo
    {
        return $this->transport->getLastRateLimit();
    }

    public function accounts(): AccountResource
    {
        return $this->resource(AccountResource::class);
    }

    public function accountBalances(): AccountBalanceResource
    {
        return $this->resource(AccountBalanceResource::class);
    }

    public function bankConnections(): BankConnectionResource
    {
        return $this->resource(BankConnectionResource::class);
    }

    public function bankMatch(): BankMatchResource
    {
        return $this->resource(BankMatchResource::class);
    }

    public function bankTransfers(): BankTransferResource
    {
        return $this->resource(BankTransferResource::class);
    }

    public function bills(): BillResource
    {
        return $this->resource(BillResource::class);
    }

    public function budgets(): BudgetResource
    {
        return $this->resource(BudgetResource::class);
    }

    public function cashSales(): CashSaleResource
    {
        return $this->resource(CashSaleResource::class);
    }

    public function classifications(): ClassificationResource
    {
        return $this->resource(ClassificationResource::class);
    }

    public function classificationLines(): ClassificationLineResource
    {
        return $this->resource(ClassificationLineResource::class);
    }

    public function companies(): CompanyResource
    {
        return $this->resource(CompanyResource::class);
    }

    public function contracts(): ContractResource
    {
        return $this->resource(ContractResource::class);
    }

    public function customFields(): CustomFieldResource
    {
        return $this->resource(CustomFieldResource::class);
    }

    public function customers(): CustomerResource
    {
        return $this->resource(CustomerResource::class);
    }

    public function customerCredits(): CustomerCreditResource
    {
        return $this->resource(CustomerCreditResource::class);
    }

    public function customerDeposits(): CustomerDepositResource
    {
        return $this->resource(CustomerDepositResource::class);
    }

    public function customerPayments(): CustomerPaymentResource
    {
        return $this->resource(CustomerPaymentResource::class);
    }

    public function customerPrepayments(): CustomerPrepaymentResource
    {
        return $this->resource(CustomerPrepaymentResource::class);
    }

    public function customerPrepaymentApplications(): CustomerPrepaymentApplicationResource
    {
        return $this->resource(CustomerPrepaymentApplicationResource::class);
    }

    public function customerRefunds(): CustomerRefundResource
    {
        return $this->resource(CustomerRefundResource::class);
    }

    public function depreciationBooks(): DepreciationBookResource
    {
        return $this->resource(DepreciationBookResource::class);
    }

    public function directExpenses(): DirectExpenseResource
    {
        return $this->resource(DirectExpenseResource::class);
    }

    public function exchangeRates(): ExchangeRateResource
    {
        return $this->resource(ExchangeRateResource::class);
    }

    public function exportJobs(): ExportJobResource
    {
        return $this->resource(ExportJobResource::class);
    }

    public function fixedAssetClasses(): FixedAssetClassResource
    {
        return $this->resource(FixedAssetClassResource::class);
    }

    public function fixedAssets(): FixedAssetResource
    {
        return $this->resource(FixedAssetResource::class);
    }

    public function gstTaxRates(): GstTaxRateResource
    {
        return $this->resource(GstTaxRateResource::class);
    }

    public function health(): HealthResource
    {
        return $this->resource(HealthResource::class);
    }

    public function inbox(): InboxResource
    {
        return $this->resource(InboxResource::class);
    }

    public function intercompanyJournalEntries(): IntercompanyJournalEntryResource
    {
        return $this->resource(IntercompanyJournalEntryResource::class);
    }

    public function invoices(): InvoiceResource
    {
        return $this->resource(InvoiceResource::class);
    }

    public function items(): ItemResource
    {
        return $this->resource(ItemResource::class);
    }

    public function journalEntries(): JournalEntryResource
    {
        return $this->resource(JournalEntryResource::class);
    }

    public function oauth(): OAuthResource
    {
        return $this->resource(OAuthResource::class);
    }

    public function paperChecks(): PaperCheckResource
    {
        return $this->resource(PaperCheckResource::class);
    }

    public function productTaxCodes(): ProductTaxCodeResource
    {
        return $this->resource(ProductTaxCodeResource::class);
    }

    public function purchaseOrders(): PurchaseOrderResource
    {
        return $this->resource(PurchaseOrderResource::class);
    }

    public function quotes(): QuoteResource
    {
        return $this->resource(QuoteResource::class);
    }

    public function recurringBills(): RecurringBillResource
    {
        return $this->resource(RecurringBillResource::class);
    }

    public function recurringInvoices(): RecurringInvoiceResource
    {
        return $this->resource(RecurringInvoiceResource::class);
    }

    public function recurringJournalEntries(): RecurringJournalEntryResource
    {
        return $this->resource(RecurringJournalEntryResource::class);
    }

    public function salesOrders(): SalesOrderResource
    {
        return $this->resource(SalesOrderResource::class);
    }

    public function statisticalJournals(): StatisticalJournalResource
    {
        return $this->resource(StatisticalJournalResource::class);
    }

    public function taxes(): TaxResource
    {
        return $this->resource(TaxResource::class);
    }

    public function vatRates(): VatRateResource
    {
        return $this->resource(VatRateResource::class);
    }

    public function vendors(): VendorResource
    {
        return $this->resource(VendorResource::class);
    }

    public function vendorCredits(): VendorCreditResource
    {
        return $this->resource(VendorCreditResource::class);
    }

    public function vendorPayments(): VendorPaymentResource
    {
        return $this->resource(VendorPaymentResource::class);
    }

    public function vendorPrepayments(): VendorPrepaymentResource
    {
        return $this->resource(VendorPrepaymentResource::class);
    }

    public function vendorPrepaymentApplications(): VendorPrepaymentApplicationResource
    {
        return $this->resource(VendorPrepaymentApplicationResource::class);
    }

    public function vendorRefunds(): VendorRefundResource
    {
        return $this->resource(VendorRefundResource::class);
    }

    public function webhooks(): WebhookResource
    {
        return $this->resource(WebhookResource::class);
    }

    public function workflows(): WorkflowResource
    {
        return $this->resource(WorkflowResource::class);
    }

    /**
     * @template T of object
     */
    private function resource(string $class): object
    {
        /** @var T */
        return $this->resources[$class] ??= new $class($this->transport);
    }
}
