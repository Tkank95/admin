<?php

namespace App\Http\Requests\Search;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SNewTutorialRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'filter1' => 'nullable|numeric',
            'filter2' => 'nullable|numeric',
            'filter3' => 'nullable|numeric',
            'datatableSearch' => 'nullable|string',
            'start_date' => 'nullable|date_format:Y-m-d|before_or_equal:end_date',
            'end_date' => 'nullable|date_format:Y-m-d|after_or_equal:start_date'
        ];
    }

    public function messages(): array
    {
        return [
            'filter1.numeric' => ':attribute không hợp lệ.',
            'filter2.numeric' => ':attribute không hợp lệ.',
            'filter3.numeric' => ':attribute không hợp lệ.',
            'start_date.date_format' => ':attribute không hợp lệ.',
            'start_date.before_or_equal' => 'Ngày bắt đầu phải nhỏ hơn hoặc bằng ngày kết thúc',
            'end_date.date_format' => ':attribute không hợp lệ.',
            'end_date.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu',
            'datatableSearch.string' => ':attribute không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'filter1' => 'Top ứng dụng',
            'filter2' => 'Ứng dụng',
            'filter3' => 'Người dùng',
            'start_date' => 'Ngày bắt đầu',
            'end_date' => 'Ngày kết thúc',
            'datatableSearch' => 'Tiêu đề hoặc Nội dung'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

}
