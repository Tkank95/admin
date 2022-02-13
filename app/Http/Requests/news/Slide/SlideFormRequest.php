<?php

namespace App\Http\Requests\news\Slide;

use Illuminate\Foundation\Http\FormRequest;

class SlideFormRequest extends FormRequest
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
            'name' => 'required|max:100',
            'link' => 'required|url',
            'status' => 'required',
            'content' => 'required',
            'description' => 'required',
            'image' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Bạn chưa nhập tên slide',
            'name.max' => 'Tên slide tối đa 100 ký tự',
            'link.required' => 'Bạn chưa nhập link liên kết slide',
            'link.url' => 'Url không hợp lệ',
            'status.required' => 'Bạn chưa chọn trạng thái của slide',
            'content.required' => 'Bạn chưa nhập nội dung miêu tả slide',
            'description.required' => 'Bạn chưa nhập nội dung mô tả các bước join job',
            'image.required' => 'Bạn chưa chọn ảnh slide'
        ];
    }
}
