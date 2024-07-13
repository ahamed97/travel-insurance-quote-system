<?php

namespace App\Livewire;

use Livewire\Component;
use App\Enums\Destination;
use App\Enums\CoverageOption;
use App\Http\Requests\QuoteRequest;
use Facades\App\Services\CreateQuoteService;

class QuoteForm extends Component
{
    public $destination;
    public $start_date;
    public $end_date;
    public $medical_expenses = false;
    public $trip_cancellation = false;
    public $number_of_travelers;
    public $quote_price;

    protected function rules()
    {
        return (new QuoteRequest())->rules();
    }

    public function calculateQuote()
    {
        $quote = CreateQuoteService::create($this->validate());

        $this->quote_price = $quote->quote_price ?? 0;
    }

    public function render()
    {
        return view('livewire.quote-form', [
            'destinations' => Destination::toArray(),
            'coverage_options' => CoverageOption::toArray(),
        ]);
    }
}
