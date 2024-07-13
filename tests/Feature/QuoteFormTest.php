<?php

use Livewire\Livewire;
use App\Livewire\QuoteForm;

test('loads the quote form', function () {
    $this->get('/')->assertSeeLivewire(QuoteForm::class);
    $this->get('/')->assertSee('TIQS');
});

test('validates the form input fields', function () {
    Livewire::test('quote-form')
        ->set('destination', '')
        ->set('start_date', '')
        ->set('end_date', '')
        ->set('medical_expenses', '')
        ->set('trip_cancellation', '')
        ->set('number_of_travelers', '')
        ->call('calculateQuote')
        ->assertHasErrors([
            'destination' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'medical_expenses' => 'required',
            'trip_cancellation' => 'required',
            'number_of_travelers' => 'required',
        ]);
});

it('validates the invalid dates validation', function () {
    Livewire::test('quote-form')
        ->set('destination', 'Europe')
        ->set('start_date', '2024-07-20')
        ->set('end_date', '2024-07-01')
        ->set('medical_expenses', true)
        ->set('trip_cancellation', false)
        ->set('number_of_travelers', 2)
        ->call('calculateQuote')
        ->assertHasErrors(['end_date' => 'after_or_equal']);
});

it('calculates the correct quote price for 2023-07-20 to 2023-07-25 date to europe with medical_expenses and trip_cancellation', function () {
    Livewire::test('quote-form')
        ->set('destination', 'europe')
        ->set('start_date', '2023-07-20')
        ->set('end_date', '2023-07-25')
        ->set('medical_expenses', true)
        ->set('trip_cancellation', true)
        ->set('number_of_travelers', 1)
        ->call('calculateQuote')
        ->assertSet('quote_price', 200.0);
});

it('calculates the correct quote price for 2023-07-20 to 2023-07-25 date to asia without medical_expenses and trip_cancellation', function () {
    Livewire::test('quote-form')
        ->set('destination', 'asia')
        ->set('start_date', '2023-07-20')
        ->set('end_date', '2023-07-25')
        ->set('medical_expenses', false)
        ->set('trip_cancellation', false)
        ->set('number_of_travelers', 1)
        ->call('calculateQuote')
        ->assertSet('quote_price', 100.0);
});

it('saves the quote data to the database', function () {
    Livewire::test('quote-form')
        ->set('destination', 'america')
        ->set('start_date', '2023-07-20')
        ->set('end_date', '2023-07-25')
        ->set('medical_expenses', true)
        ->set('trip_cancellation', true)
        ->set('number_of_travelers', 3)
        ->call('calculateQuote');

    $this->assertDatabaseHas('quotes', [
        'destination' => 'america',
        'start_date' => '2023-07-20',
        'end_date' => '2023-07-25',
        'medical_expenses' => true,
        'trip_cancellation' => true,
        'number_of_travelers' => 3,
        'quote_price' => 900.0,
    ]);
});
