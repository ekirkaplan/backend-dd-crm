<?php

namespace App\Http\Requests\Squad;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
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

    /**
     * @return array
     */
    public function attributes(): array
    {
        return __('squads.labels');
    }
}
