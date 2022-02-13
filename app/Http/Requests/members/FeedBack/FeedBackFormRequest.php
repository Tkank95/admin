<?php

namespace App\Http\Requests\members\FeedBack;

use Illuminate\Foundation\Http\FormRequest;

class FeedBackFormRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'result' => 'required|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'result' => 'Ứng dụng',
        ];
    }
}
