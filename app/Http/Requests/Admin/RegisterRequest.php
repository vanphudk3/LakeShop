<?php

namespace App\Http\Requests\Admin;

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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'admin_name' => [
                'bail',
                'required',
                'string',
            ],
            'admin_username' => [
                'bail',
                'required',
                'string',
                'unique:admins,admin_username',
            ],
            'admin_password' => [
                'bail',
                'required',
                'string',
            ],
            'admin_re_password' => [
                'bail',
                'required',
                'string',
                'same:admin_password',
            ],
        ];
    }
}
