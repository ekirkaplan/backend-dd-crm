<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'email', 'unique:users,email'],
            'role_id' => ['nullable'],
            'password' => ['required', 'confirmed', Password::min(8)]
        ];
    }

    public function attributes()
    {
        return [
            'first_name' => 'Adı',
            'last_name' => 'Soyismi',
            'email' => 'E-Posta',
            'role_id' => 'Rol',
            'password' => 'Şifre',
            'password_confirmation' => 'Şifre Onay'
        ];
    }
}
