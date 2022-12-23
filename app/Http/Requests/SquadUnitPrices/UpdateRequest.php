<?php

namespace App\Http\Requests\SquadUnitPrices;

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
            'squad_id' => ['required', 'exists:squads,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date'],
            'price' => ['required'],
        ];
    }

    public function attributes(): array
    {
        return [
            'squad_id' => "Takım",
            'start_date' => "Başlangıç Tarihi",
            'end_date' => "Bitiş Tarihi",
            'price' => "Birim Fiyat",
        ];
    }
}
