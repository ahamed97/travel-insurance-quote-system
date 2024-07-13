<?php

namespace App\Services;

use App\Models\Quote;
use Facades\App\Services\CalculateQuotePriceService;

class CreateQuoteService
{
    public function create($data)
    {
        $quotePrice = CalculateQuotePriceService::calculateQuotePrice($data);
        return Quote::create(array_merge($data, ['quote_price' => $quotePrice]));
    }
}
