<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'username'=>'required',
            'email'=>'required',
            'password'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'email.required'=>'Email không được để trống',
            'username.required'=>'Username không được để trống',
            'password.required'=>'Password không được để trống',
        ];
    }
}
