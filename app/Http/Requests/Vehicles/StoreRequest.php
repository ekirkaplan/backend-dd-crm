<?php

namespace App\Http\Requests\Vehicles;

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
            'model' => ['required', 'string'],
            'plate' => ['required', 'string', 'unique:vehicles,plate'],
        ];
    }

    public function attributes(): array
    {
        return [
            'model' => 'Model',
            'plate' => 'Plaka'
        ];
    }
}
