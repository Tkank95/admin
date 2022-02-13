<?php

namespace App\Http\Requests\Search;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SFeedBackRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'filter1' => 'nullable|integer',
            'filter2' => 'nullable|numeric|digits:10',
            'filter3' => 'nullable|string|email:rfc,dns,filter,strict,spoof|max:50',
            'datatableSearch' => 'nullable|string',
            'start_date' => 'nullable|date_format:Y-m-d|before_or_equal:end_date',
            'end_date' => 'nullable|date_format:Y-m-d|after_or_equal:start_date'
        ];
    }

    public function attributes(): array
    {
        return [
            'filter1' => 'Username',
            'filter2' => 'Số điện thoại',
            'filter3' => 'Email',
            'start_date' => 'Ngày bắt đầu',
            'end_date' => 'Ngày kết thúc',
            'datatableSearch' => 'Nội dung góp ý hoặc trả lời'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
