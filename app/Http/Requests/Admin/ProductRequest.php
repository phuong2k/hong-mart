<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => ['required', 'min:3'],
            'description' => ['nullable'],
            'slug' => ['nullable'],
            'status' => ['nullable'],
            'image' => ['image', 'mimes:jpeg,png,jpg', 'nullable'],
            'price' => ['required','integer'],
            'count' => ['nullable','integer']
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Tên sản phẩm không được bỏ trống',
            'name.min' => 'Tên sản phẩm phải lớn hơn 3 ký tự',
            'image.image' => 'Ảnh lỗi',
            'image.mimes' => 'Ảnh phải là (jpeg, png, jpg)',
            'price.required' => 'Giá sản phẩm không được bỏ trống',
            'price.integer' => 'Giá sản phẩm phải là số nguyên',
            'count.integer' => 'Số lượng sản phẩm phải là số nguyên',
        ];
    }
}
