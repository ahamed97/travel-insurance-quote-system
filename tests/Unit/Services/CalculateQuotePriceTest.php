<?php

use Carbon\Carbon;
use App\Enums\Destination;
use App\Enums\CoverageOption;
use App\Services\CalculateQuotePriceService;


it('calculates quote price', function () {
    $service = new CalculateQuotePriceService();

    $data = [
        'destination' => Destination::Europe->value,
        'start_date' => Carbon::today()->toDateString(),
        'end_date' => Carbon::today()->addDays(5)->toDateString(),
        'medical_expenses' => true,
        'trip_cancellation' => true,
        'number_of_travelers' => 2,
    ];

    $quotePrice = $service->calculateQuotePrice($data);

    expect($quotePrice)->toBe(2 * (Destination::Europe->price() + CoverageOption::MedicalExpenses->price() + CoverageOption::TripCancellation->price()));
});
