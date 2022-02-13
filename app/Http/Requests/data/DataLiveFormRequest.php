<?php

namespace App\Http\Requests\data;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class DataLiveFormRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'date' => 'required|date',
            'valid_time' => 'required|numeric|min:0|max:24',
            'valid_day' => 'required|boolean',
            'income' => 'required|integer|min:0',
            'new_fan' => 'required|integer|min:0'
        ];
    }

    public function messages(): array
    {
        return [
            'valid_day.boolean' => ':attribute nhập 0 hoặc 1',
        ];
    }

    public function attributes(): array
    {
        return [
            'date' => 'Ngày tháng năm',
            'valid_time' => 'Giờ live',
            'valid_day' => 'Ngày hiệu lực',
            'income' => 'Quà tăng mới',
            'new_fan' => 'Fan tăng mới',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
