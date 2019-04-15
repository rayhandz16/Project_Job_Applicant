<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicantRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'dateofbirth' => 'required|before:2002-04-10',
            'password' => 'required|min:8',
        ];
    }
    public function messages()
    {
        return [
            'email.unique' => 'This email has been registered!!',
            'dateofbirth.before' => 'Only above 17th years old could apply!!',
            'password.min' => 'At least the password contains 8 characters!!'
        ];
    }
}