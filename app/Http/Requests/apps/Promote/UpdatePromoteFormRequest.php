<?php

namespace App\Http\Requests\apps\Promote;

use App\Rules\NotUrl;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdatePromoteFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(Request $request): array
    {
        if (!empty($request->banner_img)) {
            return ['banner_img' => ['required','mimes:jpeg,png,jpg,gif,svg','max: 15360','image', new NotUrl]];
        }

        if (!empty($request->banner)) {
            return ['banner' => ['required','string','max:100', new NotUrl]];
        }

        return [
            'app_id' => 'required|integer',
            'title' => 'required|string|min:6|max:255',
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
            'banner_img' => 'Ảnh banner đề xuất',
            'content' => 'Nội dung đề xuất',
            'register' => 'Hướng dẫn đăng ký',
            'status' => 'Trạng thái đề xuất'
        ];
    }
}
