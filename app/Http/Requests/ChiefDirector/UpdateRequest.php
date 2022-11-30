<?php

namespace App\Http\Requests\ChiefDirector;

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
            'region_directore_id' => ['required', 'int', Rule::exists('region_directores', 'id')],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string']
        ];
    }
}
