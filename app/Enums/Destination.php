<?php

namespace App\Enums;

use App\Traits\ArrayableEnum;

enum Destination: string
{
    use ArrayableEnum;
    case Europe = 'europe';
    case Asia = 'asia';
    case America = 'america';

    public function price(): int
    {
        return match ($this) {
            self::Europe => 10,
            self::Asia => 20,
            self::America => 30,
        };
    }
}
