<?php

namespace App\Http\Services\news\NewTutorial;

use App\Models\Application;
use App\Models\New_Tutorial;
use App\Traits\StorageImageTrait;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class NewTutorialService
{
    use StorageImageTrait;

    // Insert tin tức vào database
    public function create($request): bool
    {
        $input = $request->input();

        // Lưu ảnh vào thư mục
        $image = $this->storageTraitUpload($request, 'image', 'tutorial');

        // Lấy đường dẫn link ảnh đã lưu trước đó
        $input['image'] = $image['file_path'];

        try {
            $input['user_id'] = auth()->id();

            New_Tutorial::create($input);
            Session::flash('success', 'Thêm tin: ' . $request->title . ' thành công');

        } catch (Exception $err) {
            // Lỗi thì xoá ảnh vừa tải lên
            Storage::delete(str_replace('storage', 'public', $image['file_path']));

            Session::flash('error', 'Có lỗi xảy ra. Vui lòng thử lại');
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }

        return true;
    }

    public function update($request, $id): bool
    {
        $input = $request->input();

        // Lưu ảnh vào thư mục
        $image = $this->storageTraitUpload($request, 'image_img', 'tutorial');

        if (!empty($image)) {
            // Lấy đường dẫn link ảnh đã lưu trước đó
            $input['image'] = $image['file_path'];
        }

        try {
            $input['user_id'] = auth()->id();

            $id->update($input);
            Session::flash('success', 'Cập nhật thành công: ' . $id->title);

        } catch (Exception $err) {
            // Lỗi thì xoá ảnh vừa tải lên
            if (!empty($image)) {
                Storage::delete(str_replace('storage', 'public', $image['file_path']));
            }

            Session::flash('error', 'Có lỗi xảy ra. Vui lòng thử lại');
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }
        return true;
    }

    // Lấy user tạo bài viết
    public function getUser(): Collection
    {
        return DB::table('new_tutorials')->select('new_tutorials.user_id', 'users.username')
            ->join('users', 'new_tutorials.user_id', '=', 'users.id')->groupBy('user_id')->get();
    }

    // Lấy user tạo bài viết
    public function getApplication(): Collection
    {
        return DB::table('new_tutorials')->select('new_tutorials.app_id', 'applications.name')
            ->join('applications', 'new_tutorials.app_id', '=', 'applications.id')->groupBy('app_id')->get();
    }
}
