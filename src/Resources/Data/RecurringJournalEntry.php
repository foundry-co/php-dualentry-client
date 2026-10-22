<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\RecurringStatus;
use FoundryCo\DualEntry\ValueObjects\Enums\RecurringType;

/**
 * @method $this withRrule(string $rrule)
 * @method $this withMemo(string $memo)
 * @method $this withName(string $name)
 * @method $this withDate(string $date)
 * @method $this withCompanyId(int $companyId)
 * @method $this withStatus(RecurringStatus $status)
 * @method $this withRecurringType(RecurringType $recurringType)
 * @method $this withRecordPayload(array $recordPayload)
 * @method $this withCreatedBy(?array $createdBy)
 * @method $this withUpdatedBy(?array $updatedBy)
 * @method $this withInternalId(?int $internalId)
 * @method $this withNumber(?int $number)
 * @method $this withCode(?string $code)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withCompanyCurrency(?string $companyCurrency)
 * @method $this withNextOccurrence(?string $nextOccurrence)
 * @method $this withLastGenerated(?string $lastGenerated)
 * @method $this withRecords(?array $records)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withUpdatedAt(?string $updatedAt)
 */
final class RecurringJournalEntry
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly string $rrule,
        public readonly string $memo,
        public readonly string $name,
        public readonly string $date,
        public readonly int $companyId,
        public readonly RecurringStatus $status,
        public readonly RecurringType $recurringType,
        public readonly array $recordPayload,
        public readonly ?array $createdBy = null,
        public readonly ?array $updatedBy = null,
        public readonly ?int $internalId = null,
        public readonly ?int $number = null,
        public readonly ?string $code = null,
        public readonly ?string $companyName = null,
        public readonly ?string $companyCurrency = null,
        public readonly ?string $nextOccurrence = null,
        public readonly ?string $lastGenerated = null,
        public readonly ?array $records = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $updatedAt = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created RecurringJournalEntry ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $rrule,
        string $memo,
        string $name,
        string $date,
        int $companyId,
        RecurringStatus $status,
        RecurringType $recurringType,
        array $recordPayload,
    ): self {
        return new self(
            rrule: $rrule,
            memo: $memo,
            name: $name,
            date: $date,
            companyId: $companyId,
            status: $status,
            recurringType: $recurringType,
            recordPayload: $recordPayload,
            createdBy: null,
            updatedBy: null,
            internalId: null,
            number: null,
            code: null,
            companyName: null,
            companyCurrency: null,
            nextOccurrence: null,
            lastGenerated: null,
            records: null,
            createdAt: null,
            updatedAt: null,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            rrule: $data['rrule'],
            memo: $data['memo'],
            name: $data['name'],
            date: $data['date'],
            companyId: $data['company_id'],
            status: RecurringStatus::fromWire($data['status']),
            recurringType: RecurringType::fromWire($data['recurring_type']),
            recordPayload: $data['record_payload'],
            createdBy: $data['created_by'] ?? null,
            updatedBy: $data['updated_by'] ?? null,
            internalId: $data['internal_id'] ?? null,
            number: $data['number'] ?? null,
            code: $data['code'] ?? null,
            companyName: $data['company_name'] ?? null,
            companyCurrency: $data['company_currency'] ?? null,
            nextOccurrence: $data['next_occurrence'] ?? null,
            lastGenerated: $data['last_generated'] ?? null,
            records: $data['records'] ?? null,
            createdAt: $data['created_at'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'rrule' => $this->rrule,
            'memo' => $this->memo,
            'name' => $this->name,
            'date' => $this->date,
            'company_id' => $this->companyId,
            'status' => $this->status->toWire(),
            'recurring_type' => $this->recurringType->toWire(),
            'record_payload' => $this->recordPayload,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
