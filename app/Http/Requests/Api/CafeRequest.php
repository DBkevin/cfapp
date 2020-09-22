<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CafeRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'name' => "required|min:2|unique:cafes",
            'address' => 'required',
            'city' => 'required',
            'state' => "required",
            'companies_id' => "required|exists:companies,id",
            'tel' => [
                'required',
                'regex:/^((0\d{2,3}-\d{7,8})|((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8})$/',

            ],
            'description' => 'nullable|between:1,200',
            'methods.*.brew_methods_id' => 'required|exists:brew_methods,id',
        ];
    }
    public function attributes()
    {
        return [
            'methods.*.brew_methods_id' => '您选择的冲泡方法'
        ];
    }
}
