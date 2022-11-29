<?php

namespace App\Http\Requests\RegionDirectore;

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
            'city_id' => ['required', 'int', Rule::exists('cities', 'id')],
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string']
        ];
    }
}
