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
            'customer_id' => ['required', 'int', Rule::exists('customer', 'id')],
            'product_type_id' => ['required', 'int', Rule::exists('product_types', 'id')],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date'],
            'purchase_unit_price' => ['required', 'int'],
        ];
    }
}
