<?php

namespace App\Http\Requests\Customer;

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

    public function rules()
    {
        return [
            'name' => 'required',
            'email'  =>  [
                'required',
                'string',
                'email:rfc,dns',
                'unique:customers,email',
            ],
            'password'  =>  [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',
            ],
            're_password' => 'required|same:password',
            'phone' => [
                'required',
                'numeric',
                'min:10',
            ],
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Tên không được để trống',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.regex' => 'Mật khẩu phải có ít nhất 1 ký tự viết hoa, 1 ký tự viết thường, 1 ký tự đặc biệt và 1 số',
            're_password.required' => 'Nhập lại mật khẩu không được để trống',
            're_password.same' => 'Nhập lại mật khẩu không đúng',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.min' => 'Số điện thoại phải có ít nhất 10 số',
            'phone.numeric' => 'Số điện thoại không đúng định dạng',
        ];
    }
}
