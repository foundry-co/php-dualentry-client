<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;

/**
 * @method $this withId(?int $id)
 * @method $this withName(?string $name)
 * @method $this withStatus(?string $status)
 * @method $this withCompanyId(?int $companyId)
 * @method $this withAssetAccountId(?int $assetAccountId)
 * @method $this withExpenseAccountId(?int $expenseAccountId)
 * @method $this withAccumulationAccountId(?int $accumulationAccountId)
 * @method $this withBookDefaults(?array $bookDefaults)
 */
final class FixedAssetClass
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly ?int $id = null,
        public readonly ?string $name = null,
        public readonly ?string $status = null,
        public readonly ?int $companyId = null,
        public readonly ?int $assetAccountId = null,
        public readonly ?int $expenseAccountId = null,
        public readonly ?int $accumulationAccountId = null,
        public readonly ?array $bookDefaults = null,
        public readonly bool $exists = false,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'] ?? null,
            status: $data['status'] ?? null,
            companyId: $data['company_id'] ?? null,
            assetAccountId: $data['asset_account_id'] ?? null,
            expenseAccountId: $data['expense_account_id'] ?? null,
            accumulationAccountId: $data['accumulation_account_id'] ?? null,
            bookDefaults: $data['book_defaults'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([

        ], static fn (mixed $value): bool => $value !== null);
    }
}
