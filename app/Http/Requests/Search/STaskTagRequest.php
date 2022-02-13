<?php

namespace App\Http\Requests\Search;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class STaskTagRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'datatableSearch' => 'nullable|string|max:255',
            'start_date' => 'nullable|date_format:Y-m-d|before_or_equal:end_date',
            'end_date' => 'nullable|date_format:Y-m-d|after_or_equal:start_date'
        ];
    }


    public function attributes(): array
    {
        return [
            'start_date' => 'Ngày bắt đầu',
            'end_date' => 'Ngày kết thúc',
            'datatableSearch' => 'Tên loại thẻ nhiệm vụ'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
