<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
            'title'  =>  'required|min:4|unique:blog,title,' . ($this->id ?? ''),
            'content'  =>  'required|min:4|',
            'img'  =>  'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }
    public function messages()
    {
        return [
            'required'            =>  __(':attribute không được để trống.'),
            'unique'              =>  __(':attribute '.$this->title.' đã tồn tại trong hệ thống, vui lòng nhập :attribute khác.'),
            'min'            =>  __(':attribute tối thiểu 4 ký tự.'),
            'mimes'            =>  __('đây không phải file :attribute'),
            'max'            =>  __(':attribute quá dung lượng quy định.'),
        ];
    }
    public function attributes()
    {
        return [
            'title'     =>  __('title'),
            'content'     =>  __('content'),
            'img'     =>  __('hình ảnh'),
        ];
    }
}
