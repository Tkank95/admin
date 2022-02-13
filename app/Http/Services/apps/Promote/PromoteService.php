<?php

namespace App\Http\Services\apps\Promote;

use App\Models\Promote;
use App\Traits\StorageImageTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PromoteService
{
    use StorageImageTrait;

    public function create($request): bool
    {
        $input = $request->input();

        // Lưu ảnh vào thư mục
        $bannerUpload = $this->storageTraitUpload($request, 'banner', 'app/banner');

        // Lấy đường dẫn link ảnh vừa lưu
        $input['banner'] = $bannerUpload['file_path'];

        try {
            DB::transaction(function () use ($input) {
                $this->updateStatus($input['app_id']);
                Promote::create($input);
            });

            Session::flash('success', 'Thêm đề xuất ứng dụng thành công.');

        } catch (Exception $err) {
            // Lỗi thì xoá ảnh vừa tải lên
            if (!empty($bannerUpload)) {
                Storage::delete(str_replace('storage', 'public', $bannerUpload['file_path']));
            }

            Session::flash('error', $err->getMessage());
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }

        return true;
    }

    public function update($id, $request): bool
    {
        $input = $request->input();

        // Lưu ảnh vào thư mục
        $bannerUpload = $this->storageTraitUpload($request, 'banner_img', 'app/banner');

        if (!empty($bannerUpload)) {
            $input['banner'] = $bannerUpload['file_path'];
        }

        try {
            DB::transaction(function () use ($id, $input) {
                $this->updateStatus($input['app_id']);

                $id->fill($input);
                $id->save();
            });
            Session::flash('success', 'Cập nhật đề xuất ứng dụng ' . $id->promoteApp->name . ' thành công.');

        } catch (Exception $err) {
            // Lỗi thì xoá ảnh vừa tải lên
            if (!empty($bannerUpload)) {
                Storage::delete(str_replace('storage', 'public', $bannerUpload['file_path']));
            }

            Session::flash('error', $err->getMessage());
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }

        return true;
    }

    protected function updateStatus($id): int
    {
        return DB::table('promote')->where([['app_id', '=', $id], ['status', '=', 1]])->update(['status' => 0]);
    }
}
