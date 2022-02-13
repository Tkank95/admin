<?php

namespace App\Http\Requests\members\Task;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UploadFileRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'attachFiles' => 'required|mimes:jpeg,png,jpg,gif,svg,xlsx,xls,pdf,doc,docx,ppt,pptx,csv,rar,zip,avi,mp3,wma,wav,mp4,mkv,flv,mpg,mov,txt|max: 15360'
        ];
    }

    public function attributes(): array
    {
        return [
            'attachFiles' => 'Tệp đính kèm'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
