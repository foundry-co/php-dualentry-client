<?php

namespace FoundryCo\DualEntry\ValueObjects;

use FoundryCo\DualEntry\Resources\Data\Concerns\ImmutableAttributes;

final class RecordClassification
{
    use ImmutableAttributes;

    public function __construct(
        public readonly int $id,
        public readonly string $name,
        public readonly int $lineId,
        public readonly string $lineName,
        public readonly ?int $parentClassificationId = null,
        public readonly ?int $parentClassificationLineId = null,
    ) {}

    public static function fromWire(array $data): self
    {
        return new self(
            id: $data['id'],
            name: $data['name'],
            lineId: $data['line_id'],
            lineName: $data['line_name'],
            parentClassificationId: $data['parent_classification_id'] ?? null,
            parentClassificationLineId: $data['parent_classification_line_id'] ?? null,
        );
    }

    public function toWire(): array
    {
        return [
            'id' => $this->id,
            'line_id' => $this->lineId,
        ];
    }
}
