<?php

namespace App\Services;

use App\Enums\Destination;
use App\Enums\CoverageOption;

class CalculateQuotePriceService
{
    public function calculateQuotePrice($data)
    {
        $destinationPrice = match ($data['destination']) {
            Destination::Europe->value => Destination::Europe->price(),
            Destination::Asia->value => Destination::Asia->price(),
            Destination::America->value => Destination::America->price(),
            default => 0,
        };

        $coveragePrice = ($data['medical_expenses'] ? CoverageOption::MedicalExpenses->price() : 0) + ($data['trip_cancellation'] ? CoverageOption::TripCancellation->price() : 0);
        return $data['number_of_travelers'] * ($destinationPrice + $coveragePrice);
    }
}
