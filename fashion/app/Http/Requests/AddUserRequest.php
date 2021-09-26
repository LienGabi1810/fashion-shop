<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserRequest extends FormRequest
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
            'name'=>'required',
            'phone'=>'required|numeric',
            'address'=>'required',
            'email'=>'required|unique:users,email'.$this->id,
            'password'=>'required',
            'gender'=>'required',
            'role'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Tên không được để trống',
            'phone.required'=>'Số điện thoại không được để trống',
            'phone.numeric'=>'Số điện thoại không đúng định dạng',
            'address.required'=>'Địa chỉ không được để trống',
            'email.required'=>'Email không được để trống',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Mật khẩu không được để trống',
            'gender.required'=>'Giới tính không được để trống',
            'role.required'=>'Quyền không được để trống'
        ];
    }
}
