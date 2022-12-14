<?php

namespace App\Http\Requests\CustomerUnitPrice;

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
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'product_type_id' => ['required', 'integer', 'exists:product_types,id'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'purchase_unit_price' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'customer_id' => 'Müşteri',
            'product_type_id' => 'Ürün Tipi',
            'start_date' => 'Başlangıç Tarihi',
            'end_date' => 'Bitiş Tarihi',
            'purchase_unit_price' => 'Birim Fiyatı'
        ];
    }
}
