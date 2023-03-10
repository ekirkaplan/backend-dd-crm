<?php

namespace App\Http\Requests\ExitWarehouse;

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
            'name' => ['required', 'string'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'city_id' => 'Şehir',
            'name' => 'Adı',
            'address' => 'Adres',
            'phone' => 'Telefon',
            'description' => 'Açıklama'
        ];
    }
}
