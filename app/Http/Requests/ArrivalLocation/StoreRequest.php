<?php

namespace App\Http\Requests\ArrivalLocation;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'city_id' => ['required', 'integer', Rule::exists('cities', 'id')],
            'transport_unit_price' => ['required', 'int'],
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }
}
