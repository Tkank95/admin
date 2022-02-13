<?php

namespace App\Http\Services\news\Slide;

use App\Models\Slide;
use App\Traits\StorageImageTrait;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SlideService
{
    use StorageImageTrait;

    public function create($request): bool
    {
        $input = $request->input();

        // Lưu ảnh vào thư mục
        $image = $this->storageTraitUpload($request, 'image', 'slide');

        // Lấy đường dẫn link ảnh đã lưu trước đó
        $input['image'] = $image['file_path'];

        try {
            Slide::create($input);
            Session::flash('success', 'Thêm Slide mới thành công');

        } catch (Exception $err) {
            // Lỗi thì xoá ảnh vừa tải lên
            Storage::delete(str_replace('storage', 'public', $image['file_path']));

            Session::flash('error', 'Thêm Slide Lỗi');
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }

        return true;
    }

    public function update($request, $id): bool
    {
        $input = $request->input();

        // Lưu ảnh vào thư mục
        $image = $this->storageTraitUpload($request, 'image_img', 'slide');

        if (!empty($image)) {
            // Lấy đường dẫn link ảnh đã lưu trước đó
            $input['image'] = $image['file_path'];
        }

        try {
            DB::beginTransaction();
            $this->updateDel($id, 'slides_del');
            $id->fill($input);
            $id->save();
            DB::commit();
            Session::flash('success', 'Cập nhật Slide thành công');

        } catch (Exception $err) {
            DB::rollBack();
            // Lỗi thì xoá ảnh vừa tải lên
            if (!empty($image)) {
                Storage::delete(str_replace('storage', 'public', $image['file_path']));
            }

            Session::flash('error', 'Cập nhật Slide Lỗi');
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }

        return true;
    }
}
