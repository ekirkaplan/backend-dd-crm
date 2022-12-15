<?php

namespace App\Http\Requests\Vehicles;

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
            'model' => ['required', 'string'],
            'plate' => ['required', 'string', 'unique:vehicles,plate,' . ($this->vehicle ? $this->vehicle->id : '') . ',id'],
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
