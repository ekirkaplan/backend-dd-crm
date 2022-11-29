<?php

namespace App\Http\Requests\ChiefDirectore;

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
            'region_directore_id' => ['required', 'int', Rule::exists('region_directores', 'id')],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string']
        ];
    }
}
