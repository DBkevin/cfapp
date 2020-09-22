<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

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
                    //
                    'name' => 'required|between:2,25|unique:companies,name',
                    'address' => 'required',
                    'website' => 'url',
                    'description' => 'between:10,200'
                ];
                break;
            case 'PATCH':
                return [
                    'name' => 'required|between:2,25|unique:companies,name'
                ];
                break;
        }
    }
    public function attributes()
    {
        return [
            'name' => '公司名',
            'address' => '公司地址',
            'website' => '公司网址',
            'description' => '公司简介',
        ];
    }
}
