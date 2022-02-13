<?php

namespace App\Http\Requests\apps\Application;

use App\Rules\NotUrl;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateApplicationFormRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    public function rules(Request $request): array
    {
        if (!empty($request->logo_img)) {
            return ['logo_img' => ['required','mimes:jpeg,png,jpg,gif,svg','max: 15360','image', new NotUrl]];
        }

        if (empty($request->logo)) {
            return ['logo' => ['required','string','max:100', new NotUrl]];
        }

        return [
            'cate_id' => 'required|integer',
            'name' => 'required|string|min:4|max:10',
            'link_download' => 'required|string|url|active_url|min:5|max:100',
            'top' => 'required|integer|digits_between:0,4',
            'status' => 'required|boolean'
        ];
    }

    public function attributes(): array
    {
        return [
            'cate_id' => 'Thể loại ứng dụng',
            'name' => 'Tên ứng dụng',
            'logo' => 'Logo ứng dụng',
            'logo_img' => 'Logo ứng dụng',
            'link_download' => 'Link tải ứng dụng',
            'top' => 'Mức độ hot của ứng dụng',
            'status' => 'Trạng thái ứng dụng'
        ];
    }
}
