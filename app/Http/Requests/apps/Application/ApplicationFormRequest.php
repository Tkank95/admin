<?php

namespace App\Http\Requests\apps\Application;

use App\Rules\NotUrl;
use Illuminate\Foundation\Http\FormRequest;

class ApplicationFormRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'cate_id' => 'required|integer',
            'name' => 'required|string|min:4|max:10',
            'logo' => ['required','mimes:jpeg,png,jpg,gif,svg','max: 15360','image', new NotUrl],
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
            'link_download' => 'Link tải ứng dụng',
            'top' => 'Mức độ hot của ứng dụng',
            'status' => 'Trạng thái ứng dụng'
        ];
    }
}
