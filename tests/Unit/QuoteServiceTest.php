<?php

use Carbon\Carbon;
use App\Models\Quote;
use App\Enums\Destination;
use App\Enums\CoverageOption;
use App\Services\QuoteService;


it('calculates quote price for europe with medical expenses and trip cancellation', function () {
    $service = new QuoteService();

    $data = [
        'destination' => Destination::Europe->value,
        'start_date' => Carbon::today()->toDateString(),
        'end_date' => Carbon::today()->addDays(5)->toDateString(),
        'medical_expenses' => true,
        'trip_cancellation' => true,
        'number_of_travelers' => 2,
    ];

    $quotePrice = $service->calculateQuotePrice($data);

    expect($quotePrice)->toBe((float) (2 * (Destination::Europe->price() + CoverageOption::MedicalExpenses->price() + CoverageOption::TripCancellation->price()) * 5));
});

it('calculates quote price for Asia with no coverage options', function () {
    $service = new QuoteService();

    $data = [
        'destination' => Destination::Asia->value,
        'start_date' => Carbon::today()->toDateString(),
        'end_date' => Carbon::today()->addDays(3)->toDateString(),
        'medical_expenses' => false,
        'trip_cancellation' => false,
        'number_of_travelers' => 1,
    ];

    $quotePrice = $service->calculateQuotePrice($data);

    expect($quotePrice)->toBe((float) (1 * Destination::Asia->price() * 3));
});
