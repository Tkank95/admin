<?php

namespace App\Http\Requests\apps\LiveRule;

use Illuminate\Foundation\Http\FormRequest;

class LiveRuleFormRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'app_id' => 'required|integer',
            'live_rule' => 'required|string',
            'active_day' => 'required|date',
            'status' => 'required|boolean'
        ];
    }

    public function attributes(): array
    {
        return [
            'app_id' => 'Ứng dụng',
            'live_rule' => 'Quy định live',
            'active_day' => 'Ngày quy định có hiệu lực',
            'status' => 'Trạng thái quy định'
        ];
    }
}
