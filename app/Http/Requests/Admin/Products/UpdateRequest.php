<?php

namespace App\Http\Requests\Admin\Products;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required',
            'status' => 'required',
            'image' => 'required',
            'description' => 'required',
            'special' => 'required',
            'preserve' => 'required',
            'quantity' => 'required',
            'size_id'  => 'required',
            'discount'  => 'required',
        ];
    }
}
