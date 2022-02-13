<?php

namespace App\Http\Services\apps\Application;


use App\Models\Application;
use App\Traits\StorageImageTrait;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ApplicationService
{
    use StorageImageTrait;

    public function create($request): bool
    {
        $input = $request->input();

        // Lưu ảnh vào thư mục
        $logoUpload = $this->storageTraitUpload($request, 'logo', 'app/logo');

        // Lấy đường dẫn link ảnh vừa lưu
        $input['logo'] = $logoUpload['file_path'];

        try {
            DB::transaction(function () use ($input) {
                $this->updateTop($input['cate_id'], $input['top']);
                Application::create($input);
            });

            Session::flash('success', 'Thêm ứng dụng live: ' . $input['name'] . ' thành Công');

        } catch (Exception $err) {
            // Lỗi thì xoá ảnh vừa tải lên
            Storage::delete(str_replace('storage', 'public', $logoUpload['file_path']));

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
        $logoUpload = $this->storageTraitUpload($request, 'logo_img', 'app/logo');

        if (!empty($logoUpload)) {
            // Lấy đường dẫn link ảnh vừa lưu
            $input['logo'] = $logoUpload['file_path'];
        }

        try {
            DB::transaction(function () use ($id, $input) {
                $this->updateTop($input['cate_id'], $input['top']);
                $id->fill($input);
                $id->save();
            });

            Session::flash('success', 'Cập nhật ứng dụng: ' . $id->name . ' thành công.');

        } catch (Exception $err) {
            // Lỗi thì xoá ảnh vừa tải lên
            if (!empty($logoUpload)) {
                Storage::delete(str_replace('storage', 'public', $logoUpload['file_path']));
            }

            Session::flash('error', 'Có lỗi xảy ra. Vui lòng thử lại');
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }
        return true;
    }

    // Lấy danh sách thể loại ứng dụng
    public function getParent(): Collection
    {
        return DB::table('applications')->select('id', 'name', 'status', 'updated_at')->where('cate_id', 0)->get();
    }

    // Cập nhật top ứng dụng
    protected function updateTop($cat_id, $top): int
    {
        return DB::table('applications')->where([['cate_id', '=', $cat_id], ['top', '=', $top]])->update(['top' => 0]);
    }
}
