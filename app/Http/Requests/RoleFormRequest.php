<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleFormRequest extends FormRequest
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
            'name' => 'required|unique:roles,name,'.$this->id,
            'display_name' => 'required',
        ];
    }

    public function requestedField(){
        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'display_name' => $this->display_name,
        ];
        return $data;
    }
}
