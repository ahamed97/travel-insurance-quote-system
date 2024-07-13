<?php

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Quote;
use App\Enums\Destination;
use App\Services\CreateQuoteService;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(TestCase::class, RefreshDatabase::class);

it('creates a quote', function () {

    $data = [
        'destination' => Destination::Europe->value,
        'start_date' => Carbon::today()->toDateString(),
        'end_date' => Carbon::today()->addDays(5)->toDateString(),
        'medical_expenses' => true,
        'trip_cancellation' => true,
        'number_of_travelers' => 2,
    ];

    $service = new CreateQuoteService();
    $quote = $service->create($data);

    expect($quote)->toBeInstanceOf(Quote::class);
    expect($quote->destination)->toEqual($data['destination']);
    expect($quote->start_date)->toEqual($data['start_date']);
    expect($quote->end_date)->toEqual($data['end_date']);
    expect($quote->medical_expenses)->toBeTrue();
    expect($quote->trip_cancellation)->toBeTrue();
    expect($quote->number_of_travelers)->toEqual($data['number_of_travelers']);
    expect($quote->quote_price)->toEqual(80);
});
