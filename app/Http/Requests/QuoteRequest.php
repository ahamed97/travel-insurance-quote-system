<?php

namespace App\Http\Requests;

use App\Enums\Destination;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;

class QuoteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'destination' => 'required|in:' . implode(',', Destination::toArray()),
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'medical_expenses' => 'required|boolean',
            'trip_cancellation' => 'required|boolean',
            'number_of_travelers' => 'required|integer|min:1',
        ];
    }
}
