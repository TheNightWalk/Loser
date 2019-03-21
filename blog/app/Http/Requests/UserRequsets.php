<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class UserRequsets extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'user_tel' => 'required|digits:11|numeric|unique:shop_user',
            'user_pwd' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'user_tel.required' => '请输入手机号',
            'user_tel.digits' => '手机号必须为11位的纯数字',
            'user_tel.numeric' => '手机号必须为11位的纯数字',
            'user_tel.unique' => '手机号已存在',
            'user_pwd.required' => '请输入密码',
        ];
    }
}
