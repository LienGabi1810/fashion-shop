<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Unique;

class AddProductRequest extends FormRequest
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
            'category_id'=>'required',
            'code'=>'required|unique:product,code',
            'name'=>'required',
            'quantity'=>'required|numeric',
            'price'=>'required|numeric',
            'is_hightlight'=>'required',
            'status'=>'required',
            'image'=>'required',
            'info'=>'required',
            'describe'=>'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Tên sản phẩm không được để trống',
            'category_id.required'=>'Danh mục không được để trống',
            'code.required'=>'Mã sản phẩm được để trống',
            'code.unique'=>'Mã sản phẩm đã tồn tại',
            'is_hightlight.required'=>'Là sản phẩm nổi bật không được để trống',
            'price.required'=>'giá không được để trống',
            'price.numeric'=>'Gía phải là số',
            'quantity.required'=>'Số lượng không được để trống',
            'quantity.numeric'=>'Số lượng phải là số',
            'status.required'=>'Trạng thái không được để trống',
            'image.required'=>'Ảnh sản phẩm không được để trống',
            'info.required'=>'Thông tin sản phẩm không được để trống',
            'describe.required'=>'Mô tả sản phẩm không được để trống'
        ];
    }
}
