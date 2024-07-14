<?php

namespace Tests\Unit\Livewire;

use Carbon\Carbon;
use Tests\TestCase;
use Livewire\Livewire;
use App\Enums\Destination;
use App\Livewire\QuoteForm;

uses(TestCase::class);

it('validates empty input fields', function () {
    Livewire::test(QuoteForm::class)
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

it('validates the destination field with invalid value', function () {
    Livewire::test(QuoteForm::class)
        ->set('destination', 'test')
        ->set('start_date', Carbon::today()->toDateString())
        ->set('end_date', Carbon::today()->addDays(5)->toDateString())
        ->set('medical_expenses', false)
        ->set('trip_cancellation', false)
        ->set('number_of_travelers', 0)
        ->call('calculateQuote')
        ->assertHasErrors(['destination' => 'in']);
});

it('validates the end date field with invalid value', function () {
    Livewire::test(QuoteForm::class)
        ->set('destination', Destination::Europe->value)
        ->set('start_date', Carbon::today()->toDateString())
        ->set('end_date', Carbon::today()->subDays(5)->toDateString())
        ->set('medical_expenses', false)
        ->set('trip_cancellation', false)
        ->set('number_of_travelers', 0)
        ->call('calculateQuote')
        ->assertHasErrors(['end_date' => 'after_or_equal']);
});

it('validates the number of travelers field with invalid value', function () {
    Livewire::test(QuoteForm::class)
        ->set('destination', Destination::Europe->value)
        ->set('start_date', Carbon::today()->toDateString())
        ->set('end_date', Carbon::today()->addDays(5)->toDateString())
        ->set('medical_expenses', false)
        ->set('trip_cancellation', false)
        ->set('number_of_travelers', 0)
        ->call('calculateQuote')
        ->assertHasErrors(['number_of_travelers' => 'min']);
});
