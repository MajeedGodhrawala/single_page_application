<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
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
        $rules = [
            'first_name' => 'required',
            'last_name' => 'required ',
            'email' => 'required|email|unique:users,email,'.$this->id,
            'phone_number' => 'required|digits:10|unique:users,phone_number,'.  $this->id,
            'password' => $this->id && $this->password == '' ? '' : 'required|min:8'   ,
            'confirm_password' => 'required_with:password|same:password',
            'state' => '',
            'country' => '',
            'isactive' => '',
            'profile_img' => '',
            'accept_privacy' => 'required|in:0,1' 
            // 'accept_privacy' => '' 
        ];
        return $rules;
    }

    public function requestedField(){
        $data = [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'password' => $this->password == '' || null ? User::find($this->id)->password : bcrypt($this->password) ,
            'state' => $this->state,
            'country' => $this->country,
            'isactive' => 1,
            'profile_img' => 'upload_image/img_1695386039.jpg
            ',
            'accept_privacy' => $this->accept_privacy,
        ];

        return $data;
    }
}
