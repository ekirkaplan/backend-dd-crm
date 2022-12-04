<?php

namespace App\Http\Requests\Role;

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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'permissions.*' => ['nullable']
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'İsmi',
            'permissions.*' => 'İzinler'
        ];
    }
}
