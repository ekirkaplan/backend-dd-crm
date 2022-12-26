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
            'employees' => ['array', 'nullable'],
            'employees.*.squad_start_date' => ['required', 'date'],
        ];
    }

    public function attributes(): array
    {
        return [
            'foreman_id' => 'Usta Başı',
            'employees' => 'İşçiler',
            'employees.*.squad_start_date' => 'İşçi Başlangıç Tarihi Girmediniz!',
        ];
    }
}
