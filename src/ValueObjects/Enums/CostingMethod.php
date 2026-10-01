<?php

namespace FoundryCo\DualEntry\ValueObjects\Enums;

enum CostingMethod: string
{
    case Fifo = 'FIFO';
    case WeightedAverage = 'WEIGHTED_AVERAGE';

    public static function fromWire(string $value): self
    {
        return match ($value) {
            'fifo' => self::Fifo,
            'weighted_average' => self::WeightedAverage,
        };
    }

    public function toWire(): string
    {
        return match ($this) {
            self::Fifo => 'fifo',
            self::WeightedAverage => 'weighted_average',
        };
    }
}
