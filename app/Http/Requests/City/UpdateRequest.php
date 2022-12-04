<?php

namespace App\Http\Requests\City;

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
            'country_id' => ['required', 'integer', 'countries:exists,id'],
            'name' => ['required', 'string']
        ];
    }

    public function attributes(): array
    {
        return [
            'country_id' => 'Ülke',
            'name' => 'Şehir İsmi',
        ];
    }
}
