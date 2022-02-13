<?php

namespace App\Http\Requests\apps\Policy;

use Illuminate\Foundation\Http\FormRequest;

class PolicyFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'app_id' => 'required|integer',
            'policy_idol' => 'required|string',
            'policy_agency' => 'required|string',
            'active_day' => 'required|date',
            'status' => 'required|boolean'
        ];
    }

    public function attributes(): array
    {
        return [
            'app_id' => 'Ứng dụng',
            'policy_idol' => 'Chính sách lương Idol',
            'policy_agency' => 'Chính sách lương Agency',
            'active_day' => 'Ngày chính sách có hiệu lực',
            'status' => 'Trạng thái chính sách'
        ];
    }
}
