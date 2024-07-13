<?php

namespace App\Traits;

use BackedEnum;
use InvalidArgumentException;

trait ArrayableEnum
{
    public static function toArray(): array
    {
        if (!is_subclass_of(static::class, BackedEnum::class)) {
            throw new InvalidArgumentException(sprintf('"%s" is not a "BackedEnum" class.', static::class));
        }

        return array_map(fn ($type) => $type->value, static::cases());
    }
}
