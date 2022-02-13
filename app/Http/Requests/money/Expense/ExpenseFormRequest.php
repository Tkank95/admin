<?php

namespace App\Http\Requests\money\Expense;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ExpenseFormRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'payment_date' => 'required|date_format:Y-m-d H:i:s',
            'expense_cate' => 'required|integer',
            'amount_vnd' => 'required|integer',
            'amount_usd' => 'nullable|numeric',
            'rate' => 'nullable|integer',
            'description' => 'nullable|string'
        ];
    }

    public function attributes(): array
    {
        return [
            'payment_date' => 'Thời gian thanh toán',
            'expense_cate' => 'Tên loại chi phí',
            'amount_vnd' => 'Số tiền VNĐ',
            'amount_usd' => 'Số tiền USD',
            'rate' => 'Tỉ giá USD',
            'description' => 'Ghi chú, mô tả'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
