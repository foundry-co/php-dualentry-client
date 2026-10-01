<?php

namespace FoundryCo\DualEntry\Resources\Data\Concerns;

use BadMethodCallException;
use ReflectionClass;

/**
 * Gives a readonly Data/value object immutable "wither" mutation, PSR-7
 * style, without generating a with-method body per property: `with()` is
 * reflection-driven (reads the constructor's own parameter list, so there's
 * nothing to keep in sync), and `withX()` for a single field is handled by
 * __call rather than ~20-30 near-identical generated methods per class.
 *
 *     $invoice->with(['memo' => 'Updated', 'dueDate' => '2026-03-01']);
 *     $invoice->withMemo('Updated')->withDueDate('2026-03-01');
 */
trait ImmutableAttributes
{
    public function with(array $attributes): static
    {
        $parameters = [];

        foreach ((new ReflectionClass(static::class))->getConstructor()->getParameters() as $parameter) {
            $name = $parameter->getName();
            $parameters[$name] = array_key_exists($name, $attributes)
                ? $attributes[$name]
                : $this->{$name};
        }

        return new static(...$parameters);
    }

    public function __call(string $name, array $arguments): static
    {
        if (str_starts_with($name, 'with') && strlen($name) > 4) {
            $property = lcfirst(substr($name, 4));

            if (property_exists($this, $property)) {
                return $this->with([$property => $arguments[0] ?? null]);
            }
        }

        throw new BadMethodCallException(sprintf('Call to undefined method %s::%s()', static::class, $name));
    }
}
