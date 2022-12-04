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
            'name' => ['required', 'unique:squads.name'],
            'employees' => ['nullable', 'array']
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Ekip Adı',
            'employees' => 'İşçiler'
        ];
    }
}
