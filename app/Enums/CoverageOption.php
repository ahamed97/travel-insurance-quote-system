<?php

namespace App\Enums;

use App\Traits\ArrayableEnum;

enum CoverageOption: string
{
    use ArrayableEnum;
    case MedicalExpenses = 'mdical_expenses';
    case TripCancellation = 'trip_cancellation';

    public function price(): int
    {
        return match ($this) {
            self::MedicalExpenses => 10,
            self::TripCancellation => 20,
        };
    }
}
