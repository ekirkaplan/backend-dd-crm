<?php

namespace App\Http\Requests\Squad;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return \string[][]
     */
    public function rules(): array
    {
        return [
            'foreman_id' => ['required', 'exists:employees,id'],
            'name' => ['required', 'unique:squads.name'],
            'employees' => ['nullable', 'array']
        ];
    }
}
