<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchAdvancedRequest extends FormRequest
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
            'name' => 'required',
            'price' => 'required',
            'cate' => 'required',
            'brand' => 'required',
            'status' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'required' =>':attribute không được để trống',
        ];
    }
    public function attributes()
    {
        return [
            'name' => 'Tên sản phẩm',
            'price' => 'Giá sản phẩm',
            'cate' => 'Loại sản phẩm',
            'brand' => 'Hãng sản phẩm',
            'status' => 'Trạng thái sản phẩm',
        ];
    }
}
