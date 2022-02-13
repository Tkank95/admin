<?php

namespace App\Http\Requests\members\Bank;

use Illuminate\Foundation\Http\FormRequest;

class BankFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
            'name' => 'required|string|min:6|max:30',
            'account' => 'required|numeric|digits_between:10,20',
            'bank_name' => 'required|string|min:2|max:30',
            'branch' => 'required|string|min:5|max:20'
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'Người dùng',
            'name' => 'Họ và tên chủ tài khoản',
            'account' => 'Số tài khoản',
            'bank_name' => 'Tên ngân hàng',
            'branch' => 'Chi nhánh mở tài khoản ngân hàng',
        ];
    }
}
