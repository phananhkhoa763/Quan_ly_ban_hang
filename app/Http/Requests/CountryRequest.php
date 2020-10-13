<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
            'name'  =>  'required|unique:country,name,' . ($this->id ?? ''),
        ];
    }
    public function messages()
    {
        return [
            'required'            =>  __(':attribute không được để trống.'),
            'unique'              =>  __(':attribute -'. $this->name .'- đã tồn tại trong hệ thống, vui lòng nhập :attribute khác.'),
        ];
    }
    public function attributes() {
        return [
            'name'     =>  __('Tên quốc gia '),
        ];
    }
}
