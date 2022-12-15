<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'title' => ['required', 'string'],
            'address' => ['nullable', 'string'],
            'phone' => ['nullable', 'string'],
            'email' => ['nullable', 'string'],
            'tax_no' => ['required', 'integer'],
            'tax_office_id' => ['required', 'integer', 'exists:tax_offices,id'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function attributes()
    {
        return [
            'city_id' => 'Şehir',
            'title' => 'Unvanı',
            'address' => 'Adres',
            'phone' => 'Telefonu',
            'email' => 'E-Posta',
            'tax_no' => 'Vergi Numarası',
            'tax_office_id' => 'Vergi Dairesi',
            'description' => 'Açıklama'
        ];
    }
}
