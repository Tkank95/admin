<?php

namespace App\Http\Requests\Search;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class SExpense extends FormRequest
{
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'filter1' => 'nullable|date_format:Y-m-d',
            'filter2' => 'nullable|required_with:filter3|integer|before_or_equal:filter3',
            'filter3' => 'nullable|required_with:filter2|integer|after_or_equal:filter2',
            'unit' => 'nullable|required_with:filter2|ends_with:vnd,usd',
            'datatableSearch' => 'nullable|string|max:255',
            'start_date' => 'nullable|required_with:end_date|date_format:Y-m-d|before_or_equal:end_date',
            'end_date' => 'nullable|required_with:start_date|date_format:Y-m-d|after_or_equal:start_date'
        ];
    }

    public function messages(): array
    {
        return [
            'filter2.before_or_equal' => 'Số tiền đầu phải phỏ hơn số tiền cuối.',
            'filter3.after_or_equal' => 'Số tiền cuối phải lớn hơn số tiền đầu.',
        ];
    }

    public function attributes(): array
    {
        return [
            'filter1' => 'Ngày giờ thanh toán',
            'filter2' => '"Tiền thanh toán"',
            'filter3' => '"Đến khoảng số tiền"',
            'unit' => 'Đơn vị tiền',
            'start_date' => 'Ngày bắt đầu',
            'end_date' => 'Ngày kết thúc',
            'datatableSearch' => 'Tên loại chi phí'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
