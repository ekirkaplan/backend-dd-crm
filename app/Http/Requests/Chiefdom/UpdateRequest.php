<?php

namespace App\Http\Requests\Chiefdom;

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
            'chief_director_id' => ['required', 'int', 'exists:chief_directors,id'],
            'name' => ['required', 'string'],
            'phone' => ['nullable', 'string'],
            'address' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'chief_director_id' => "İşletme Müdürlüğü",
            'name' => "Adı",
            'phone' => "Telefon Numarası",
            'address' => "Adres",
            'description' => "Açıklama",
        ];
    }
}
