<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Test extends FormRequest
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
            'catenate_name' => 'required|unique:catenate|max:255',
            'catenate_URL' => 'required|URL',
            'catenate_tel' => 'required|digits:11|numeric',
            'catenate_Logo' => 'dimensions|required'
        ];
    }

    public function messages()
    {
        return [
            'catenate_name.required'    => '网址名称不能为空',
            'catenate_name.unique'    => '网址名称已存在',
            'catenate_name.required'    => '网址名称最大值为255',
            'catenate_URL.required'    => '网址URL不能为空',
            'catenate_URL.URL'    => '请输入正确的URL格式',
            'catenate_tel.required'    => '电话不能为空',
            'catenate_tel.digits' => '电话必须为11位的纯数字',
            'catenate_tel.numeric' => '电话必须为11位的纯数字',
            'catenate_Logo.dimensions'  => '只能上传图片',
            'catenate_Logo.required'  => 'Logo不能为空',
        ];
    }
}
