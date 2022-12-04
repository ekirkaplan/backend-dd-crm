<?php

namespace App\Http\Requests\ChiefDirector;

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
            'region_director_id' => ['required', 'integer', 'exists:region_directors,id'],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string']
        ];
    }

    public function attributes(): array
    {
        return [
            'region_director_id' => 'Bölğesel Müdürlük',
            'name' => 'Bölğe Müdürlük İsmi',
            'description' => 'Açıklama',
        ];
    }
}
