<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email_phonenumber' => 'required',
            'password' => 'required|min:8',
        ];
    }

    public function requestedFieldEmail(){
        return [
            'email' => $this->email_phonenumber,
            'password' => $this->password,
        ];
    }

    public function requestedFieldPhoneNumber(){
        return [
            'phone_number' => (float) $this->email_phonenumber,
            'password' => $this->password,
        ];
    }

}
