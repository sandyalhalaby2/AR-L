<?php

namespace App\Http\Requests\OtpVerify;

use App\Http\Requests\ValidationFormRequest;

class generateRequest extends ValidationFormRequest
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
            'phone_number' => 'required|exists:users,phone_number'
        ];
    }
}
