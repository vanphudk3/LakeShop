<?php

namespace App\Http\Requests\Customer;

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
            'email' => [
                'bail',
                'required',
                'string',
                
            ],
            'password' => [
                'bail',
                'required',
                'string',
                
            ]
        ];
    }
}
