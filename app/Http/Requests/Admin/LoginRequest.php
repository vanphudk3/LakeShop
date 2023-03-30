<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'admin_username' => [
                'bail',
                'required',
                'string',
            ],
            'admin_password' => [
                'bail',
                'required',
                'string',
            ]
        ];
    }
}
