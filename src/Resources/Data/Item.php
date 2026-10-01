<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\BillingCadence;
use FoundryCo\DualEntry\ValueObjects\Enums\CostingMethod;
use FoundryCo\DualEntry\ValueObjects\Enums\ItemTypes;
use FoundryCo\DualEntry\ValueObjects\Enums\RecognitionStrategy;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\SystemCurrencies;

/**
 * @method $this withName(string $name)
 * @method $this withIsActive(bool $isActive)
 * @method $this withSku(string $sku)
 * @method $this withItemType(ItemTypes $itemType)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withId(?int $id)
 * @method $this withCode(?string $code)
 * @method $this withDescription(?string $description)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withProductTaxCodeId(?int $productTaxCodeId)
 * @method $this withExpenseAccountId(?int $expenseAccountId)
 * @method $this withIncomeAccountId(?int $incomeAccountId)
 * @method $this withDeferralAccountId(?int $deferralAccountId)
 * @method $this withAssetAccountId(?int $assetAccountId)
 * @method $this withDiscountAccountId(?int $discountAccountId)
 * @method $this withDefaultClassificationLineIds(?array $defaultClassificationLineIds)
 * @method $this withDefaultRevRecMethod(?RecognitionStrategy $defaultRevRecMethod)
 * @method $this withDefaultRevRecInvoiceFrequency(?BillingCadence $defaultRevRecInvoiceFrequency)
 * @method $this withDefaultRevRecInvoiceInterval(?int $defaultRevRecInvoiceInterval)
 * @method $this withDefaultStandaloneSellingPrice(?string $defaultStandaloneSellingPrice)
 * @method $this withDefaultStandaloneSellingPriceCurrencyIso4217Code(?SystemCurrencies $defaultStandaloneSellingPriceCurrencyIso4217Code)
 * @method $this withDefaultStandaloneSellingPriceExchangeRate(?string $defaultStandaloneSellingPriceExchangeRate)
 * @method $this withCostingMethod(?CostingMethod $costingMethod)
 * @method $this withStockUnit(?string $stockUnit)
 */
final class Item
{
    use ImmutableAttributes;

    private function __construct(
        public readonly string $name,
        public readonly bool $isActive,
        public readonly string $sku,
        public readonly ItemTypes $itemType,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?string $description = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?int $productTaxCodeId = null,
        public readonly ?int $expenseAccountId = null,
        public readonly ?int $incomeAccountId = null,
        public readonly ?int $deferralAccountId = null,
        public readonly ?int $assetAccountId = null,
        public readonly ?int $discountAccountId = null,
        public readonly ?array $defaultClassificationLineIds = null,
        public readonly ?RecognitionStrategy $defaultRevRecMethod = null,
        public readonly ?BillingCadence $defaultRevRecInvoiceFrequency = null,
        public readonly ?int $defaultRevRecInvoiceInterval = null,
        public readonly ?string $defaultStandaloneSellingPrice = null,
        public readonly ?SystemCurrencies $defaultStandaloneSellingPriceCurrencyIso4217Code = null,
        public readonly ?string $defaultStandaloneSellingPriceExchangeRate = null,
        public readonly ?CostingMethod $costingMethod = null,
        public readonly ?string $stockUnit = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created Item ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $name,
        bool $isActive,
        string $sku,
        ItemTypes $itemType,
        ?string $description = null,
        ?RecordStatus $recordStatus = null,
        ?int $productTaxCodeId = null,
        ?int $expenseAccountId = null,
        ?int $incomeAccountId = null,
        ?int $deferralAccountId = null,
        ?int $assetAccountId = null,
        ?int $discountAccountId = null,
        ?array $defaultClassificationLineIds = null,
        ?RecognitionStrategy $defaultRevRecMethod = null,
        ?BillingCadence $defaultRevRecInvoiceFrequency = null,
        ?int $defaultRevRecInvoiceInterval = null,
        ?string $defaultStandaloneSellingPrice = null,
        ?SystemCurrencies $defaultStandaloneSellingPriceCurrencyIso4217Code = null,
        ?CostingMethod $costingMethod = null,
        ?string $stockUnit = null,
    ): self {
        return new self(
            name: $name,
            isActive: $isActive,
            sku: $sku,
            itemType: $itemType,
            createdAt: null,
            updatedAt: null,
            createdBy: null,
            updatedBy: null,
            id: null,
            code: null,
            description: $description,
            recordStatus: $recordStatus,
            productTaxCodeId: $productTaxCodeId,
            expenseAccountId: $expenseAccountId,
            incomeAccountId: $incomeAccountId,
            deferralAccountId: $deferralAccountId,
            assetAccountId: $assetAccountId,
            discountAccountId: $discountAccountId,
            defaultClassificationLineIds: $defaultClassificationLineIds,
            defaultRevRecMethod: $defaultRevRecMethod,
            defaultRevRecInvoiceFrequency: $defaultRevRecInvoiceFrequency,
            defaultRevRecInvoiceInterval: $defaultRevRecInvoiceInterval,
            defaultStandaloneSellingPrice: $defaultStandaloneSellingPrice,
            defaultStandaloneSellingPriceCurrencyIso4217Code: $defaultStandaloneSellingPriceCurrencyIso4217Code,
            defaultStandaloneSellingPriceExchangeRate: null,
            costingMethod: $costingMethod,
            stockUnit: $stockUnit,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            name: $data['name'],
            isActive: $data['is_active'],
            sku: $data['sku'],
            itemType: ItemTypes::fromWire($data['item_type']),
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            id: $data['id'] ?? null,
            code: $data['code'] ?? null,
            description: $data['description'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            productTaxCodeId: $data['product_tax_code_id'] ?? null,
            expenseAccountId: $data['expense_account_id'] ?? null,
            incomeAccountId: $data['income_account_id'] ?? null,
            deferralAccountId: $data['deferral_account_id'] ?? null,
            assetAccountId: $data['asset_account_id'] ?? null,
            discountAccountId: $data['discount_account_id'] ?? null,
            defaultClassificationLineIds: $data['default_classification_line_ids'] ?? null,
            defaultRevRecMethod: isset($data['default_rev_rec_method']) ? RecognitionStrategy::fromWire($data['default_rev_rec_method']) : null,
            defaultRevRecInvoiceFrequency: isset($data['default_rev_rec_invoice_frequency']) ? BillingCadence::fromWire($data['default_rev_rec_invoice_frequency']) : null,
            defaultRevRecInvoiceInterval: $data['default_rev_rec_invoice_interval'] ?? null,
            defaultStandaloneSellingPrice: $data['default_standalone_selling_price'] ?? null,
            defaultStandaloneSellingPriceCurrencyIso4217Code: isset($data['default_standalone_selling_price_currency_iso_4217_code']) ? SystemCurrencies::fromWire($data['default_standalone_selling_price_currency_iso_4217_code']) : null,
            defaultStandaloneSellingPriceExchangeRate: $data['default_standalone_selling_price_exchange_rate'] ?? null,
            costingMethod: isset($data['costing_method']) ? CostingMethod::fromWire($data['costing_method']) : null,
            stockUnit: $data['stock_unit'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'name' => $this->name,
            'is_active' => $this->isActive,
            'sku' => $this->sku,
            'item_type' => $this->itemType->toWire(),
            'description' => $this->description,
            'record_status' => $this->recordStatus?->toWire(),
            'product_tax_code_id' => $this->productTaxCodeId,
            'expense_account_id' => $this->expenseAccountId,
            'income_account_id' => $this->incomeAccountId,
            'deferral_account_id' => $this->deferralAccountId,
            'asset_account_id' => $this->assetAccountId,
            'discount_account_id' => $this->discountAccountId,
            'default_classification_line_ids' => $this->defaultClassificationLineIds,
            'default_rev_rec_method' => $this->defaultRevRecMethod?->toWire(),
            'default_rev_rec_invoice_frequency' => $this->defaultRevRecInvoiceFrequency?->toWire(),
            'default_rev_rec_invoice_interval' => $this->defaultRevRecInvoiceInterval,
            'default_standalone_selling_price' => $this->defaultStandaloneSellingPrice,
            'default_standalone_selling_price_currency_iso_4217_code' => $this->defaultStandaloneSellingPriceCurrencyIso4217Code?->toWire(),
            'costing_method' => $this->costingMethod?->toWire(),
            'stock_unit' => $this->stockUnit,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
