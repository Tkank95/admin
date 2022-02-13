<?php

namespace App\Http\Services\members\User;

use App\Models\members\User;
use App\Models\Role;
use App\Traits\InsertDel;
use App\Traits\StorageImageTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class UserService
{
    use StorageImageTrait, InsertDel;

    public function create($request): bool
    {
        $input = $request->input();

        // Lưu ảnh vào thư mục avatar
        $avatarUpload = $this->storageTraitUpload($request, 'avatar', 'avatar');

        // Lấy đường dẫn link ảnh đã lưu trước đó
        $input['avatar'] = $avatarUpload['file_path'];

        try {
            DB::beginTransaction();

            // Mã hoá mật khẩu
            $input['password'] = Hash::make($input['password']);

            // Lưu thông tin vào bảng user
            $user = User::create($input);

            // Lưu thông tin user vào bảng member_info
            $user->userInfo()->create($input);

            // Lưu thông tin user vào bảng role_user
            $user->roles()->attach($request->role);

            DB::commit();
            Session::flash('success', 'Thêm user: ' . $request->name . ' Thành Công');

        } catch (Exception $err) {
            DB::rollBack();
            // Lỗi thì xoá ảnh vừa tải lên
            Storage::delete(str_replace('storage', 'public', $avatarUpload['file_path']));

            Session::flash('error', 'Có lỗi xảy ra. Vui lòng thử lại');
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }

        return true;
    }

    public function update($id, $request): bool
    {
        $input = $request->input();
        $avatarUpload = $this->storageTraitUpload($request, 'avatar_img', 'avatar');

        if (!empty($avatarUpload)) {
            $input['avatar'] = $avatarUpload['file_path'];
        }

        try {
            DB::beginTransaction();

            // Nếu đổi mật khẩu thì update mật khẩu
            if (!empty($request->password)) {
                $input['password'] = Hash::make($input['password']);
            }

            // Update thông tin user và lưu lại
            $id->fill($input);
            $id->save();

            // Update thông tin user trong bảng member_info
            $id->userInfo->update($request->all());

            // Update thông tin user trong bảng role_user
            $id->roles()->sync($request->role);

            DB::commit();
            Session::flash('success', 'Update user: ' . $request->name . ' Thành Công');

        } catch (Exception $err) {
            DB::rollBack();
            // Lỗi thì xoá ảnh vừa tải lên
            if (!empty($avatarUpload)) {
                Storage::delete(str_replace('storage', 'public', $avatarUpload['file_path']));
            }

            Session::flash('error', 'Có lỗi xảy ra. Vui lòng thử lại');
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }

        return true;
    }

    // Lấy tất cả nhóm quyền
    public function getRole()
    {
        return Role::all();
    }

    // Khoá hoặc mở tài khoản user
    public function ban($id, $request): bool
    {
        try {
            // Nếu banned = 0 thì mở khoá
            if ($request->banned_until == 0) {
                $id->update(['banned_until' => null]);
            } else {
                // Update thời gian banned số ngày band vào số ngày hiện tại
                $id->update(['banned_until' => now()->addDays($request->banned_until)]);
            }
        } catch (Exception $err) {
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }

        return true;
    }
}
