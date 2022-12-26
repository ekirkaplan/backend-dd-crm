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
            'employees' => ['array', 'nullable'],
            'employees.*.squad_start_date' => ['required', 'date'],
        ];
    }

    public function attributes()
    {
        return [
            'foreman_id' => 'Usta Başı',
            'employees' => 'İşçiler',
            'employees.*.squad_start_date' => 'İşçi Başlangıç Tarihi Girmediniz!',
        ];
    }
}
