<?php

namespace App\Http\Requests\TaxOffice;

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
            'name' => 'string|required'
        ];
    }
    public function attributes()
    {
        return [
            'name' => "Vergi Dairesinin Adı"
        ];
    }


}
