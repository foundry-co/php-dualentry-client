<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\BudgetTypes;
use FoundryCo\DualEntry\ValueObjects\Enums\RecordStatus;

/**
 * @method $this withId(?int $id)
 * @method $this withCode(?string $code)
 * @method $this withName(?string $name)
 * @method $this withCompanyId(?int $companyId)
 * @method $this withCompanyName(?string $companyName)
 * @method $this withBudgetType(?BudgetTypes $budgetType)
 * @method $this withCalendarYear(?int $calendarYear)
 * @method $this withStartDate(?string $startDate)
 * @method $this withEndDate(?string $endDate)
 * @method $this withRecordStatus(?RecordStatus $recordStatus)
 * @method $this withActualsOffsetInMonths(?int $actualsOffsetInMonths)
 * @method $this withClassifications(?array $classifications)
 * @method $this withUpdatedAt(?string $updatedAt)
 */
final class Budget
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly ?int $id = null,
        public readonly ?string $code = null,
        public readonly ?string $name = null,
        public readonly ?int $companyId = null,
        public readonly ?string $companyName = null,
        public readonly ?BudgetTypes $budgetType = null,
        public readonly ?int $calendarYear = null,
        public readonly ?string $startDate = null,
        public readonly ?string $endDate = null,
        public readonly ?RecordStatus $recordStatus = null,
        public readonly ?int $actualsOffsetInMonths = null,
        public readonly ?array $classifications = null,
        public readonly ?string $updatedAt = null,
        public readonly bool $exists = false,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            code: $data['code'] ?? null,
            name: $data['name'] ?? null,
            companyId: $data['company_id'] ?? null,
            companyName: $data['company_name'] ?? null,
            budgetType: isset($data['budget_type']) ? BudgetTypes::fromWire($data['budget_type']) : null,
            calendarYear: $data['calendar_year'] ?? null,
            startDate: $data['start_date'] ?? null,
            endDate: $data['end_date'] ?? null,
            recordStatus: isset($data['record_status']) ? RecordStatus::fromWire($data['record_status']) : null,
            actualsOffsetInMonths: $data['actuals_offset_in_months'] ?? null,
            classifications: $data['classifications'] ?? null,
            updatedAt: $data['updated_at'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([

        ], static fn (mixed $value): bool => $value !== null);
    }
}
