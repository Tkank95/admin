<?php

namespace App\Http\Requests\data\ApplyJob;

use Illuminate\Foundation\Http\FormRequest;

class ApplyJobFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|integer',
            'app_id' => 'required|integer',
            'id_in_app' => 'required|min:4|max:15|string',
            'nickname' => 'required|max:50|string',
            'team' => 'required|min:2|max:15|string',
            'worked' => 'required|boolean',
            'talent' => 'required|min:2|max:100|string',
            'game' => 'nullable|min:2|max:100|string',
            'experience' => 'nullable|min:2|max:100|string',
            'video_casting' => 'nullable|min:2|max:100|string|url|active_url',
            'rank_image' => 'nullable|min:2|max:100|string|url|active_url',
            'cast_datetime' => 'nullable|date',

            'number_cmnd' => ['nullable', 'regex:/\b\d{9}\b|\d{12}/'],
            'cmnd_mt' => 'nullable|min:2|max:100',
            'cmnd_ms' => 'nullable|min:2|max:100',
            'selfie_cmnd' => 'nullable|min:2|max:100',
            'selfie' => 'nullable|min:2|max:100',
            'selfie_team' => 'nullable|min:2|max:100',
            'video_proof' => 'nullable|min:2|max:100|string|url|active_url',

            'result' => 'required|integer|digits_between:0,2',
            'wage' => 'nullable|numeric',
            'contract' => 'required|boolean',
            'contract_status' => 'nullable|integer|digits_between:0,4',
            'active' => 'required|boolean',
            'pass_date' => 'nullable|date',
            'start_day' => 'nullable|date',
            'policy' => 'required|min:2|max:100|string|url|active_url',
            'note' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => ':attribute không được để trống.',
            'user_id.integer' => ':attribute không hợp lệ.',
            'user_id.numeric' => ':attribute không hợp lệ.',
            'app_id.required' => ':attribute không được để trống.',
            'app_id.integer' => ':attribute không hợp lệ.',
            'app_id.numeric' => ':attribute không hợp lệ.',
            'id_in_app.required' => ':attribute không được để trống.',
            'id_in_app.min' => ':attribute tối thiểu 4 ký tự.',
            'id_in_app.max' => ':attribute tối đa 15 ký tự.',
            'id_in_app.string' => ':attribute không hợp lệ.',
            'nickname.required' => ':attribute không được để trống.',
            'nickname.max' => ':attribute tối đa 50 ký tự.',
            'nickname.string' => ':attribute không hợp lệ.',
            'team.required' => ':attribute không được để trống.',
            'team.min' => ':attribute tối thiểu 2 ký tự.',
            'team.max' => ':attribute tối đa 15 ký tự',
            'team.string' => ':attribute không hợp lệ.',
            'worked.required' => ':attribute không được để trống.',
            'worked.boolean' => ':attribute không hợp lệ.',
            'talent.required' => ':attribute không được để trống.',
            'talent.min' => ':attribute tối thiểu 2 ký tự.',
            'talent.max' => ':attribute tối đa 100 ký tự.',
            'talent.string' => ':attribute không hợp lệ.',
            'game.min' => ':attribute tối thiểu 2 ký tự.',
            'game.max' => ':attribute tối đa 100 ký tự.',
            'game.string' => ':attribute không hợp lệ.',
            'experience.min' => ':attribute tối thiểu 2 ký tự.',
            'experience.max' => ':attribute tối đa 100 ký tự.',
            'experience.string' => ':attribute không hợp lệ.',
            'video_casting.min' => ':attribute tối thiểu 2 ký tự.',
            'video_casting.max' => ':attribute tối đa 100 ký tự.',
            'video_casting.string' => ':attribute không hợp lệ.',
            'video_casting.url' => ':attribute không đúng.',
            'video_casting.active_url' => ':attribute không đúng hoặc chưa kích hoạt.',
            'rank_image.min' => ':attribute tối thiểu 2 ký tự.',
            'rank_image.max' => ':attribute tối đa 100 ký tự.',
            'rank_image.string' => ':attribute không hợp lệ.',
            'rank_image.url' => ':attribute không đúng.',
            'rank_image.active_url' => ':attribute không đúng hoặc chưa kích hoạt.',
            'cast_datetime.date' => ':attribute tối đa 100 ký tự.',

            'number_cmnd.numeric' => ':attribute là số.',
            'number_cmnd.regex' => ':attribute 9 hoặc 12 số.',
            'cmnd_mt.min' => ':attribute tối thiểu 2 ký tự.',
            'cmnd_mt.max' => ':attribute tối đa 100 ký tự.',
            'cmnd_ms.min' => ':attribute tối thiểu 2 ký tự.',
            'cmnd_ms.max' => ':attribute tối đa 100 ký tự.',
            'selfie_cmnd.min' => ':attribute tối thiểu 2 ký tự.',
            'selfie_cmnd.max' => ':attribute tối đa 100 ký tự.',
            'selfie.min' => ':attribute tối thiểu 2 ký tự.',
            'selfie.max' => ':attribute tối đa 100 ký tự.',
            'selfie_team.min' => ':attribute tối thiểu 2 ký tự.',
            'selfie_team.max' => ':attribute tối đa 100 ký tự.',
            'video_proof.min' => ':attribute tối thiểu 2 ký tự.',
            'video_proof.max' => ':attribute tối đa 100 ký tự.',
            'video_proof.string' => ':attribute không hợp lệ.',
            'video_proof.url' => ':attribute không đúng.',
            'video_proof.active_url' => ':attribute không đúng hoặc chưa kích hoạt.',

            'result' => 'required|integer|digits_between:0,2',
            'wage' => 'nullable|numeric',
            'contract' => 'required|boolean',
            'contract_status' => 'required|integer|digits_between:0,4',
            'active' => 'required|boolean',
            'pass_date' => 'nullable|date',
            'start_day' => 'nullable|date',
            'policy' => 'required|min:2|max:100|string|url|active_url',
            'note' => 'nullable|string',

            'result.required' => ':attribute không được để trống.',
            'result.integer' => ':attribute không hợp lệ.',
            'result.digits_between' => ':attribute không hợp lệ.',
            'wage.numeric' => ':attribute không hợp lệ.',
            'contract.boolean' => ':attribute không hợp lệ.',
            'contract_status.integer' => ':attribute không hợp lệ.',
            'contract_status.digits_between' => ':attribute không hợp lệ.',
            'active.boolean' => ':attribute không hợp lệ.',
            'pass_date.date' => ':attribute không hợp lệ.',
            'start_day.date' => ':attribute không hợp lệ.',
            'policy.required' => ':attribute không được để trống.',
            'policy.min' => ':attribute tối thiểu 2 ký tự.',
            'policy.max' => ':attribute tối đa 100 ký tự.',
            'policy.string' => ':attribute không hợp lệ.',
            'policy.url' => ':attribute không đúng.',
            'policy.active_url' => ':attribute không đúng hoặc chưa kích hoạt.',
            'note.string' => ':attribute không hợp lệ.',
        ];
    }

    public function attributes(): array
    {
        return [
            'user_id' => 'Người dùng',
            'app_id' => 'Ứng dụng',
            'id_in_app' => 'ID ứng dụng',
            'nickname' => 'Nickname',
            'team' => 'Team',
            'worked' => 'Old Idol',
            'talent' => 'Tài năng, nội dung live',
            'game' => 'Game live',
            'experience' => 'Những app từng live',
            'video_casting' => 'Link video casting',
            'rank_image' => 'Rank trong game',
            'cast_datetime' => 'Ngày casting',
            'number_cmnd' => 'Số CMND/CCCD',
            'cmnd_mt' => 'CMND/CCCD mặt trước',
            'cmnd_ms' => 'CMND/CCCD mặt sau',
            'selfie_cmnd' => 'Idol chụp cùng CMND/CCCD',
            'selfie' => 'Ảnh Idol',
            'selfie_team' => 'Idol chụp cùng thông tin team',
            'video_proof' => 'Link video chứng minh thu nhập cao ở app khác',
            'result' => 'Kết quả cast',
            'wage' => 'Mức lương cứng',
            'contract' => 'Hợp đồng',
            'contract_status' => 'Trạng thái hợp đồng',
            'active' => 'Hiệu lực live',
            'pass_date' => 'Ngày đậu casting',
            'start_day' => 'Ngày bắt đầu tính dữ liệu live',
            'policy' => 'Link chính sách lương',
            'note' => 'Ghi chú',
        ];
    }
}
