<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;

/**
 * @method $this withAccountId(int $accountId)
 * @method $this withId(?int $id)
 * @method $this withNumber(?int $number)
 * @method $this withCode(?string $code)
 * @method $this withAccountName(?string $accountName)
 * @method $this withAccountNumber(?int $accountNumber)
 * @method $this withPeriod(?string $period)
 * @method $this withDate(?string $date)
 * @method $this withMemo(?string $memo)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withTotalQuantity(?string $totalQuantity)
 * @method $this withItems(?array $items)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 */
final class StatisticalJournal
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly int $accountId,
        public readonly ?int $id = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        public readonly ?string $accountName = null,
        public readonly ?int $accountNumber = null,
        public readonly ?string $period = null,
        public readonly ?string $date = null,
        public readonly ?string $memo = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?string $totalQuantity = null,
        /** @var array<int, StatisticalJournalLineItem> */
        public readonly ?array $items = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created StatisticalJournal ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        int $accountId,
        ?string $date = null,
        ?string $memo = null,
        ?RecordStatus $recordStatus = null,
        /** @var array<int, StatisticalJournalLineItem> */
        ?array $items = null,
    ): self {
        return new self(
            accountId: $accountId,
            id: null,
            number: null,
            code: null,
            accountName: null,
            accountNumber: null,
            period: null,
            date: $date,
            memo: $memo,
            recordStatus: $recordStatus,
            totalQuantity: null,
            items: $items,
            createdAt: null,
            updatedAt: null,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            accountId: $data['account_id'],
            id: $data['id'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            accountName: $data['account_name'] ?? null,
            accountNumber: $data['account_number'] ?? null,
            period: $data['period'] ?? null,
            date: $data['date'] ?? null,
            memo: $data['memo'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            totalQuantity: $data['total_quantity'] ?? null,
            items: array_map(static fn (array $row): StatisticalJournalLineItem => StatisticalJournalLineItem::fromWire($row), $data['items'] ?? []),
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'account_id' => $this->accountId,
            'date' => $this->date,
            'memo' => $this->memo,
            'record_status' => $this->recordStatus?->toWire(),
            'items' => array_map(static fn (StatisticalJournalLineItem $row): array => $row->toWire(), $this->items),
        ], static fn (mixed $value): bool => $value !== null);
    }
}
