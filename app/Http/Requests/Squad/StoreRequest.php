<?php

namespace App\Http\Requests\Squad;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:squads.name'],
            'employees' => ['nullable', 'array']
        ];
    }

    public function attributes()
    {
        return __('squads.labels');
    }

}
