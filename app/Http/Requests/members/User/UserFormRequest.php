<?php

namespace App\Http\Requests\members\User;

use App\Rules\NotUrl;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class UserFormRequest extends FormRequest
{
    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    public function rules()
    {
        return [
            'name' => 'required|string|min:6|max:30',
            'email' => 'required|string|unique:users,email|email:rfc,dns,filter,strict,spoof|max:50',
            'username' => 'required|string|min:6|max:15|unique:users,username|alpha_num',
            'password' => 'required|string|min:8|max:32',
            'position' => 'required|integer|digits_between:1,5',
            'avatar' => ['required','mimes:jpeg,png,jpg,gif,svg','max: 15360','image', new NotUrl],
            'status' => 'required|boolean',
            'banned_until' => 'nullable|datetime',

            'confirmpassword' => 'required|same:password',

            'gender' => 'required|boolean',
            'phone' => 'required|numeric|digits:10',
            'birthday' => 'required|date|before_or_equal:' . Carbon::now()->subYears(13)->format('Y-m-d'),
            'address' => 'required|string|min:8|max:100',
            'facebook' => 'required|string|url|active_url|min:5|max:100',
            'team' => 'nullable|string|min:2|max:15',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ':attribute không được để trống.',
            'name.string' => ':attribute không hợp lệ.',
            'name.min' => ':attribute tối thiểu 6 ký tự',
            'name.max' => ':attribute tối đa 30 ký tự',

            'email.required' => ':attribute không được để trống.',
            'email.string' => ':attribute không hợp lệ.',
            'email.email' => ':attribute không hợp lệ.',
            'email.unique' => ':attribute đã có người sử dụng.',
            'email.max' => ':attribute tối đa 50 ký tự',

            'username.required' => ':attribute không được để trống.',
            'username.string' => ':attribute không hợp lệ.',
            'username.alpha_dash' => ':attribute bao gồm chữ cái và số.',
            'username.min' => ':attribute tối thiểu 6 ký tự.',
            'username.max' => ':attribute tối đa 15 ký tự.',
            'username.unique' => ':attribute đã có người sử dụng.',

            'password.required' => ':attribute không được để trống.',
            'password.string' => ':attribute không hợp lệ.',
            'password.min' => ':attribute tối thiểu 8 ký tự',
            'password.max' => ':attribute tối đa 100 ký tự',

            'position.required' => ':attribute không được để trống.',
            'position.integer' => ':attribute là số.',
            'position.digits_between' => ':attribute không hợp lệ.,',

            'avatar.required' => ':attribute không được để trống.',
            'avatar.mimes' => ':attribute không đúng định dạng ảnh.',
            'avatar.image' => ':attribute phải là hình ảnh.',
            'avatar.max' => ':attribute tối đa 15mb.',

            'status.required' => ':attribute không được để trống.',
            'status.boolean' => ':attribute không hợp lệ.',

            'banned_until.datetime' => ':attribute không hợp lệ.',

            'confirmpassword.required' => 'Nhập lại mật khẩu không được để trống.',
            'confirmpassword.same' => 'Mật khẩu nhập lại không đúng.',

            // Member_info
            'gender.required' => ':attribute không được để trống.',
            'gender.boolean' => ':attribute không hợp lệ.',

            'phone.required' => ':attribute không được để trống.',
            'phone.numeric' => ':attribute là số',
            'phone.digits' => ':attribute gồm 10 số',

            'birthday.required' => ':attribute không được để trống.',
            'birthday.date' => ':attribute không hợp lệ.',
            'birthday.before_or_equal' => 'Bạn chưa đủ 13 tuổi.',

            'address.required' => ':attribute không được để trống.',
            'address.string' => ':attribute không hợp lệ.',
            'address.min' => ':attribute tối thiểu 8 ký tự',
            'address.max' => ':attribute tối đa 100 ký tự',

            'facebook.required' => ':attribute không được để trống.',
            'facebook.string' => ':attribute không hợp lệ.',
            'facebook.url' => ':attribute không đúng',
            'facebook.active_url' => ':attribute không đúng hoặc chưa kích hoạt',
            'facebook.max' => ':attribute tối đa 100 ký tự',

            'team.string' => ':attribute không hợp lệ.',
            'team.min' => ':attribute tối thiểu 2 ký tự',
            'team.max' => ':attribute tối thiểu 15 ký tự'

        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Họ và tên',
            'email' => 'Email',
            'username' => 'Username',
            'password' => 'Mật khẩu',
            'position' => 'Chức vụ',
            'avatar' => 'Ảnh đại diện',
            'status' => 'Trạng thái tài khoản',
            'banned_until' => 'Thời gian khoá tài khoản',

            // Member_info
            'gender' => 'Giới tính',
            'phone' => 'Số điện thoại',
            'birthday' => 'Ngày sinh',
            'address' => 'Địa chỉ',
            'facebook' => 'Link Facebook',
            'team' => 'Tên team Agency',
        ];
    }
}
