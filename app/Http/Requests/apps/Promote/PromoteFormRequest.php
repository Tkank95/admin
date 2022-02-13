<?php

namespace App\Http\Requests\apps\Promote;

use App\Rules\NotUrl;
use Illuminate\Foundation\Http\FormRequest;

class PromoteFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'app_id' => 'required|integer',
            'title' => 'required|string|min:6|max:255',
            'banner' => ['required','mimes:jpeg,png,jpg,gif,svg','max: 15360','image', new NotUrl],
            'content' => 'required|string',
            'register' => 'required|string',
            'status' => 'required|boolean'
        ];
    }

    public function attributes(): array
    {
        return [
            'app_id' => 'Ứng dụng',
            'title' => 'Tiêu đề đề xuất',
            'banner' => 'Ảnh banner đề xuất',
            'content' => 'Nội dung đề xuất',
            'register' => 'Hướng dẫn đăng ký',
            'status' => 'Trạng thái đề xuất'
        ];
    }
}
