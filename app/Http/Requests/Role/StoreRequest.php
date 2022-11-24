<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'permission.*' => ['nullable']
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'name' => __('role.labels.name'),
            'permission.*' => __('role.labels.permission'),
        ];
    }
}
