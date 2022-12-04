<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'company_id' => ['required', 'exists:companies,id'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'address' => ['nullable', 'string'],
            'description' => ['nullable', 'string']
        ];
    }

    public function attributes()
    {
        return [
            'company_id' => 'Firma',
            'first_name' => 'Adı',
            'last_name' => 'Soyadı',
            'phone' => 'Telefonu',
            'address' => 'Adres',
            'description' => 'Açıklama'
        ];
    }
}
