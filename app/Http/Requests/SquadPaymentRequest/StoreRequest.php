<?php

namespace App\Http\Requests\SquadPaymentRequest;

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
            'squad_id' => ['required', 'exists:squads,id'],
            'contract_id' => ['required', 'exists:contracts,id'],
            'payment_request_date' => ['required', 'date'],
            'request_amount' => ['required'],
            'description' => ['nullable', 'string']
        ];
    }

    public function attributes(): array
    {
        return [
            'squad_id' => "Kesim Ekibi",
            'contract_id' => "Sözleşme",
            'payment_request_date' => "Talep Edilme Tarihi",
            'request_amount' => "Miktar",
            'description' => "Açıklama"
        ];
    }


}
