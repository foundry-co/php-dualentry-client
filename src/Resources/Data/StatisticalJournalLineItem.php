<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;

/**
 * @method $this withValue(string $value)
 * @method $this withId(?int $id)
 * @method $this withCompanyId(?int $companyId)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withAccountId(?int $accountId)
 * @method $this withAccountName(?string $accountName)
 * @method $this withAccountNumber(?int $accountNumber)
 * @method $this withPosition(?int $position)
 * @method $this withMemo(?string $memo)
 * @method $this withClassifications(?array $classifications)
 */
final class StatisticalJournalLineItem
{
    use ImmutableAttributes;

    public function __construct(
        public readonly string $value,
        public readonly ?int $id = null,
        public readonly ?int $companyId = null,
        public readonly ?string $companyName = null,
        public readonly ?int $accountId = null,
        public readonly ?string $accountName = null,
        public readonly ?int $accountNumber = null,
        public readonly ?int $position = null,
        public readonly ?string $memo = null,
        public readonly ?array $classifications = null,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            value: $data['value'],
            id: $data['id'] ?? null,
            companyId: $data['company_id'] ?? null,
            companyName: $data['company_name'] ?? null,
            accountId: $data['account_id'] ?? null,
            accountName: $data['account_name'] ?? null,
            accountNumber: $data['account_number'] ?? null,
            position: $data['position'] ?? null,
            memo: $data['memo'] ?? null,
            classifications: $data['classifications'] ?? null,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'value' => $this->value,
            'id' => $this->id,
            'company_id' => $this->companyId,
            'account_id' => $this->accountId,
            'position' => $this->position,
            'memo' => $this->memo,
            'classifications' => $this->classifications,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
