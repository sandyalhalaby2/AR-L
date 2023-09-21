<?php

namespace App\Http\Requests\Register;

use App\Http\Requests\ValidationFormRequest;
use App\Models\User;

class SignUpRequest extends ValidationFormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_name' => 'required|string|max:34',

            'email' => 'required|string|email|max:255|unique:users',

            'password' => 'required|string|min:8|max:34',

            'phone_number' => 'required|string|min:10|max:20',

        ];
    }

}
