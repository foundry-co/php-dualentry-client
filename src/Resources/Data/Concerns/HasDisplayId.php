<?php

namespace FoundryCo\DualEntry\Resources\Data\Concerns;

trait HasDisplayId
{
    public function displayId(): ?string
    {
        $identifier = $this->number ?? $this->id ?? null;

        return $identifier === null ? null : static::idPrefix().'-'.$identifier;
    }

    public static function idPrefix(): string
    {
        return defined(static::class.'::ID_PREFIX') ? static::ID_PREFIX : 'XX';
    }
}
