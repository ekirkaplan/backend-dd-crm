<?php

namespace App\Http\Requests\Employee;

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
            'company_id' => ['required', 'integer', 'exists:companies,id'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date'],
            'phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'type' => ['required', 'integer'],
            'description' => ['nullable', 'string']
        ];
    }

    public function attributes()
    {
        return [
            'company_id' => 'Şirket',
            'first_name' => 'Adı',
            'last_name' => 'Soyadı',
            'start_date' => "Başlangıç Tarihi",
            'end_date' => "Çıkış Tarihi",
            'phone' => 'Telefonu',
            'address' => 'Adres',
            'description' => 'Açıklama'
        ];
    }
}
