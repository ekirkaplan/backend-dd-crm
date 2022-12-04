<?php

namespace App\Http\Requests\RegionDirector;

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
            'city_id' => ['required', 'integer', 'cities:exists,id'],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string']
        ];
    }

    public function attributes()
    {
        return [
            'city_id' => 'Şehir',
            'name' => 'Bölğesel Müdürlük İsmi',
            'description' => 'Açıklama'
        ];
    }
}
