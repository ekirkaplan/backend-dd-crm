<?php

namespace App\Http\Requests\SquadPaymentTransactions;

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
            'payment_transaction_type_id' => ['required', 'int', 'exists:payment_transaction_types,id'],
            'contract_id' => ['required', 'int', 'exists:contracts,id'],
            'squad_id' => ['required', 'int', 'exists:squads,id'],
            'payment_date' => ['required'],
            'payment_amount' => ['required'],
            'description' => ['nullable'],
        ];
    }

    public function attributes(): array
    {
        return [
            'payment_transaction_type_id' => "İşlem Tipi",
            'contact_id' => "Kesim Sözleşmesi",
            'squad_id' => "Kesim Ekibi",
            'total_transaction_amount' => "Toplam İşlem Miktarı",
            'total_payment_amount' => "Toplam Ödenen Miktar",
            'payment_date' => "Ödeme Tarihi",
            'payment_amount' => "Ödeme Miktarı",
            'description' => "Açıklama",
        ];
    }
}
