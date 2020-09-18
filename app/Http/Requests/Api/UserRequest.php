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
        switch ($this->method()) {
            case 'POST':
                return [
                    //
                    'name' => 'required|between:2,25|unique:users,name',
                    'password' => 'required|alpha_dash|min:6',
                ];
                break;
            case 'PATCH':
                $userId = auth('api')->id();
                return [
                    'name' => 'between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . $userId,
                    'email' => 'email|unique:users,email,' . $userId,
                    'introduction' => 'max:80',
                    'avatar_image_id' => 'exists:images,id,type,avatar,user_id,' . $userId,
                ];
                break;
        }
    }
    public function attributes()
    {
        return [
            'name' => '用户名',
            'password' => '密码',
        ];
    }
    public function messages()
    {
        return [
            'name.unique' => '用户名已被占用，请重新填写',
            'name.regex' => '用户名只支持英文、数字、横杆和下划线。',
            'name.between' => '用户名必须介于 3 - 25 个字符之间。',
            'name.required' => '用户名不能为空。',
        ];
    }
}
