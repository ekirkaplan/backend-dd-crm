<?php

namespace App\Http\Requests\Drivers;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'first_name' => "İsim",
            'last_name' => "Soyisim",
            'phone' => "Telefon Numarası",
        ];
    }
}
