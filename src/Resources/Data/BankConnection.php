<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;

/**
 * @method $this withConnectionSourceId(string $connectionSourceId)
 * @method $this withInstitutionName(string $institutionName)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 * @method $this withId(?int $id)
 * @method $this withBankUrl(?string $bankUrl)
 * @method $this withIconUrl(?string $iconUrl)
 * @method $this withStatus(?string $status)
 * @method $this withSuccessfullyAggregatedAt(?string $successfullyAggregatedAt)
 * @method $this withLastSyncAt(?string $lastSyncAt)
 * @method $this withAccounts(?array $accounts)
 */
final class BankConnection
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly string $connectionSourceId,
        public readonly string $institutionName,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly ?int $id = null,
        public readonly ?string $bankUrl = null,
        public readonly ?string $iconUrl = null,
        public readonly ?string $status = null,
        public readonly ?string $successfullyAggregatedAt = null,
        public readonly ?string $lastSyncAt = null,
        public readonly ?array $accounts = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created BankConnection ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $connectionSourceId,
        string $institutionName,
        ?string $bankUrl = null,
        ?string $iconUrl = null,
        ?array $accounts = null,
    ): self {
        return new self(
            connectionSourceId: $connectionSourceId,
            institutionName: $institutionName,
            createdAt: null,
            updatedAt: null,
            id: null,
            bankUrl: $bankUrl,
            iconUrl: $iconUrl,
            status: null,
            successfullyAggregatedAt: null,
            lastSyncAt: null,
            accounts: $accounts,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            connectionSourceId: $data['connection_source_id'],
            institutionName: $data['institution_name'],
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            id: $data['id'] ?? null,
            bankUrl: $data['bank_url'] ?? null,
            iconUrl: $data['icon_url'] ?? null,
            status: $data['status'] ?? null,
            successfullyAggregatedAt: $data['successfully_aggregated_at'] ?? null,
            lastSyncAt: $data['last_sync_at'] ?? null,
            accounts: $data['accounts'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'connection_source_id' => $this->connectionSourceId,
            'institution_name' => $this->institutionName,
            'bank_url' => $this->bankUrl,
            'icon_url' => $this->iconUrl,
            'accounts' => $this->accounts,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
