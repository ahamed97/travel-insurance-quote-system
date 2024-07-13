<?php

use Carbon\Carbon;
use Livewire\Livewire;
use App\Enums\Destination;
use App\Livewire\QuoteForm;

test('loads the quote form', function () {
    $this->get('/')->assertSeeLivewire(QuoteForm::class);
    $this->get('/')->assertSee('TIQS');
});

it('saves the quote data to the database', function () {
    Livewire::test('quote-form')
        ->set('destination', Destination::America->value)
        ->set('start_date', Carbon::today()->toDateString())
        ->set('end_date', Carbon::today()->addDays(5)->toDateString())
        ->set('medical_expenses', true)
        ->set('trip_cancellation', true)
        ->set('number_of_travelers', 3)
        ->call('calculateQuote');

    $this->assertDatabaseHas('quotes', [
        'destination' => Destination::America->value,
        'start_date' => Carbon::today()->toDateString(),
        'end_date' => Carbon::today()->addDays(5)->toDateString(),
        'medical_expenses' => true,
        'trip_cancellation' => true,
        'number_of_travelers' => 3,
        'quote_price' => 180,
    ]);
});

it('calculates the correct quote price', function () {
    Livewire::test('quote-form')
        ->set('destination', 'asia')
        ->set('start_date', '2023-07-20')
        ->set('end_date', '2023-07-25')
        ->set('medical_expenses', false)
        ->set('trip_cancellation', false)
        ->set('number_of_travelers', 1)
        ->call('calculateQuote')
        ->assertSet('quote_price', 20);
});
