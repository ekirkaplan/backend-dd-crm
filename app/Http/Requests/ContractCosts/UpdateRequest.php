<?php

namespace App\Http\Requests\ContractCosts;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'contract_id' => ['required', 'int', 'exists:contracts,id'],
            'cost_type_id' => ['required', 'int', 'exists:cost_types,id'],
            'squad_id' => ['required', 'int', 'exists:squads,id'],
            'cost_amount' => ['required'],
            'description' => ['nullable', 'string']
        ];
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'contract_id' => "Kesim Sözleşmesi",
            'cost_type_id' => "Maliyet Türü",
            'squad_id' => "Kesim Ekibi",
            'cost_amount' => "Maliyet Tutarı",
            'description' => "Açıklama"
        ];
    }
}
