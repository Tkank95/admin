<?php

namespace App\Http\Requests\news\New_Tutorial;

use Illuminate\Foundation\Http\FormRequest;

class NewTutorialFormRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->can('update', $this->id) or $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'title' => 'required|min:4|max:100|string',
            'user_id' => 'numeric',
            'app_id' => 'required|numeric',
            'content' => 'required',
            'top' => 'required|numeric|digits_between:0,4',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max: 15360|image',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Bạn chưa nhập :attribute.',
            'title.string' => ':attribute không được có ký tự đặc biệt.',
            'title.min' => ':attribute tối thiểu 6 ký tự.',
            'title.max' => ':attribute tối đa 10 ký tự.',
            'user_id.numeric' => 'Lỗi xác thực :attribute',
            'app_id.required' => 'Bạn chưa chọn :attribute',
            'app_id.numeric' => ':attribute là số',
            'top.required' => 'Bạn chưa chọn :attribute',
            'top.numeric' => ':attribute là số',
            'top.digits_between' => ':attribute nằm trong top 4',
            'content.required' => 'Bạn chưa nhập :attribute',
            'image.required' => 'Bạn chưa chọn :attribute',
            'image.max' => 'Tên file :attribute tối đa 100 ký tự',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'Tiêu đề tin tức',
            'user_id' => 'Người dùng',
            'app_id' => 'Ứng dụng',
            'content' => 'Nội dung',
            'top' => 'Độ nổi bật',
            'image' => 'Ảnh tin tức'
        ];
    }
}
