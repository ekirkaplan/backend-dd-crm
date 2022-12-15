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
            'employees' => ['nullable', 'array']
        ];
    }

    public function attributes()
    {
        return [
            'foreman_id' => 'Usta Başı',
            'employees' => 'İşçiler'
        ];
    }
}
