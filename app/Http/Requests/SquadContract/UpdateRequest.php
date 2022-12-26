<?php

namespace App\Http\Requests\SquadContract;

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
            'squad_id' => ['required', 'integer', 'exists:squads,id'],
            'contract_id' => ['required', 'integer', 'exists:contracts,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['nullable', 'date']
        ];
    }

    public function attributes(): array
    {
        return [
            'squad_id' => "Kesim EKibi",
            'contract_id' => "Kesim Sözleşmesi",
            'start_date' => "Başlangıç Tarihi",
            'end_date' => "Bitiş Tarihi"
        ];
    }
}
