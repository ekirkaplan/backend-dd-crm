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
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'transport_unit_price' => ['required', 'integer'],
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function attributes(): array
    {
        return [
            'city_id' => 'Şehir',
            'transport_unit_price' => 'Transfer Birim Fiyatı',
            'name' => 'Varış Lokasyon İsmi',
            'address' => 'Adres',
            'description' => 'Açıklama',
        ];
    }
}
