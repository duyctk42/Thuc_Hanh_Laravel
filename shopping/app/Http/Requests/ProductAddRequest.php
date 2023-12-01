<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductAddRequest extends FormRequest
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
            'name' => 'bail|required|unique:products|max:255|min:10',
            'price' =>'required',
            'category_id' =>'required',
            'contents' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên không được phép để trống',
            'name.unique' => 'Tên không được phép trùng',
            'name.max' => 'Tên không được phép quá dài',
            'name.min' => 'Tên không được phép quá ngắn',
            'category_id.required'  => 'Danh mục không được để trống',
            'contents.required'  => 'nội dung không được để trống',
            'price.required'  => 'giá không được để trống',
        ];
    }
}
