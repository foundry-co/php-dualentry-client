<?php

namespace FoundryCo\DualEntry\Resources\Data;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;

/**
 * @method $this withUrl(string $url)
 * @method $this withUuid(?string $uuid)
 * @method $this withTopics(?array $topics)
 * @method $this withIsActive(?bool $isActive)
 * @method $this withDisabledAt(?string $disabledAt)
 * @method $this withDisabledReason(?string $disabledReason)
 * @method $this withCreatedAt(?string $createdAt)
 * @method $this withLastModifiedAt(?string $lastModifiedAt)
 */
final class Webhook
{
    use ImmutableAttributes;

    private function __construct(
        public readonly string $url,
        public readonly ?string $uuid = null,
        public readonly ?array $topics = null,
        public readonly ?bool $isActive = null,
        public readonly ?string $disabledAt = null,
        public readonly ?string $disabledReason = null,
        public readonly ?string $createdAt = null,
        public readonly ?string $lastModifiedAt = null,
        public readonly bool $exists = false,
    ) {}

    /**
     * Build a fresh, not-yet-created Webhook ($exists is false) — the
     * only public way to construct one. Pass it to create().
     */
    public static function make(
        string $url,
        ?array $topics = null,
        ?bool $isActive = null,
    ): self {
        return new self(
            url: $url,
            uuid: null,
            topics: $topics,
            isActive: $isActive,
            disabledAt: null,
            disabledReason: null,
            createdAt: null,
            lastModifiedAt: null,
            exists: false,
        );
    }

    public static function fromWire(array $data): self
    {
        return new self(
            url: $data['url'],
            uuid: $data['uuid'] ?? null,
            topics: $data['topics'] ?? null,
            isActive: $data['is_active'] ?? null,
            disabledAt: $data['disabled_at'] ?? null,
            disabledReason: $data['disabled_reason'] ?? null,
            createdAt: $data['created_at'] ?? null,
            lastModifiedAt: $data['last_modified_at'] ?? null,
            exists: true,
        );
    }

    public function toWire(): array
    {
        return array_filter([
            'url' => $this->url,
            'topics' => $this->topics,
            'is_active' => $this->isActive,
        ], static fn (mixed $value): bool => $value !== null);
    }
}
