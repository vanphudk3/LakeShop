<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            // 'email' => 'required|email',
            // 'name' => 'required',
            // 'phone' => 'required',
            // 'address' => 'bail|required',
            // 'city' => 'required|not_in:0',
            // 'district' => 'required|not_in:0',
            // 'ward'  => 'required|not_in:0',
            // 'payment' => 'required',
        ];
    }

    public function messages(){
        return [
            // 'email.required' => 'Email không được để trống',
            // 'email.email' => 'Email không đúng định dạng',
            // 'name.required' => 'Tên không được để trống',
            // 'phone.required' => 'Số điện thoại không được để trống',
            // 'address.required' => 'Địa chỉ không được để trống',
            // 'city.required' => 'Vui lòng chọn tỉnh/thành phố',
            // 'city.not_in' => 'Vui lòng nhập tỉnh/thành phố',
            // 'district.required' => 'Vui lòng chọn quận/huyện',
            // 'district.not_in' => 'Vui lòng nhập quận/huyện',
            // 'ward.required' => 'Vui lòng chọn phường/xã',
            // 'ward.not_in' => 'Vui lòng nhập phường/xã',
            // 'payment.required' => 'Phương thức thanh toán không được để trống',
        ];
    }
}
