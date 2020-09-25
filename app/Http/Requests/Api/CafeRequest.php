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
        switch ($this->method()) {
            case 'POST':

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
                    'images.*.images_id' => 'required|nullable|exists:images,id',
                    'description' => 'nullable|between:1,200',
                    'methods.*.brew_methods_id' => 'required|exists:brew_methods,id',
                    'tags.*.tags_id' => 'exists:tags,id',
                ];
                break;
            case 'PATCH':
                return [
                    'address' => 'nullable',
                    'city' => 'nullable',
                    'state' => "nullable",
                    'companies_id' => "nullable|exists:companies,id",
                    'tel' => [
                        'nullable',
                        'regex:/^((0\d{2,3}-\d{7,8})|((13[0-9])|(14[5,7])|(15[0-3,5-9])|(17[0,3,5-8])|(18[0-9])|166|198|199)\d{8})$/',

                    ],
                    'images.*.images_id' => 'required|exists:images,id',
                    'description' => 'nullable|between:1,200',
                    'methods.*.brew_methods_id' => 'required|nullable|exists:brew_methods,id',
                    'tags.*.tags_id' => 'exists:tags,id',
                ];
                break;
        }
    }
    public function attributes()
    {
        return [
            'methods.*.brew_methods_id' => '您选择的冲泡方法',
            'images.*.images_id' => "图片选择错误",
            'tags.*.tags_id' => '选择的标签'
        ];
    }
}
