<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
            'name' => 'required|between:2,25|unique:users,name',
            'password' => 'required|alpha_dash|min:6',
        ];
    }
    public function attributes()
    {
        return [
            'name' => '用户名',
            'password' => '密码',
        ];
    }
}
