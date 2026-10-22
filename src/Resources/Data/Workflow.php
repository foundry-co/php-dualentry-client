<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\HasDisplayId;
use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;
use FoundryCo\DualEntry\ValueObjects\Enums\PublicRecordType;

/**
 * @method $this withId(?int $id)
 * @method $this withRecordType(?PublicRecordType $recordType)
 * @method $this withName(?string $name)
 * @method $this withIsActive(?bool $isActive)
 * @method $this withDescription(?string $description)
 * @method $this withVersion(?int $version)
 * @method $this withPriority(?int $priority)
 * @method $this withCompanyIds(?array $companyIds)
 * @method $this withAppliesToAllCompanies(?bool $appliesToAllCompanies)
 * @method $this withAllowSelfApproval(?bool $allowSelfApproval)
 * @method $this withSteps(?array $steps)
 * @method $this withPendingApprovalCount(?int $pendingApprovalCount)
 * @method $this withRoles(?array $roles)
 */
final class Workflow
{
    use HasDisplayId;
    use ImmutableAttributes;

    private function __construct(
        public readonly ?int $id = null,
        public readonly ?PublicRecordType $recordType = null,
        public readonly ?string $name = null,
        public readonly ?bool $isActive = null,
        public readonly ?string $description = null,
        public readonly ?int $version = null,
        public readonly ?int $priority = null,
        public readonly ?array $companyIds = null,
        public readonly ?bool $appliesToAllCompanies = null,
        public readonly ?bool $allowSelfApproval = null,
        public readonly ?array $steps = null,
        public readonly ?int $pendingApprovalCount = null,
        public readonly ?array $roles = null,
        public readonly bool $exists = false,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            recordType: isset($data['record_type']) ? PublicRecordType::fromWire($data['record_type']) : null,
            name: $data['name'] ?? null,
            isActive: $data['is_active'] ?? null,
            description: $data['description'] ?? null,
            version: $data['version'] ?? null,
            priority: $data['priority'] ?? null,
            companyIds: $data['company_ids'] ?? null,
            appliesToAllCompanies: $data['applies_to_all_companies'] ?? null,
            allowSelfApproval: $data['allow_self_approval'] ?? null,
            steps: $data['steps'] ?? null,
            pendingApprovalCount: $data['pending_approval_count'] ?? null,
            roles: $data['roles'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([

        ], static fn (mixed $value): bool => $value !== null);
    }
}
