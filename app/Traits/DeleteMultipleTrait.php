<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;

trait DeleteMultipleTrait
{
    use Devices, InsertDel;

    public function deleteMultipleTrait($model, $name, $column, $table, $table_del, $column_other = null, $table_other = null,
                                        $table_del_other = null): JsonResponse
    {
        try {
            $result = $model->whereIn('id', explode(",", request('ids')));

            // Xoá ảnh nếu có
//            if ($image_type != ''){
//                $result->each(function ($path, $key) use ($image_type) {
//                    $paths = str_replace('storage', 'public', $path->$image_type);
//                    Storage::delete($paths);
//                });
//            }

            DB::transaction(function () use ($table_del_other, $table_other, $column_other, $column, $table, $name, $result, $table_del) {
                $data = $result->get();

                // Ghi nhật ký
                activity($name)
                    ->withProperty('delete', $data)
                    ->tap(function (Activity $activity) {
                        $activity->causer_type = Str::title($this->name);
                        $activity->subject_type = request()->fullUrl();
                        $activity->ip = request()->ip();
                        $activity->agent = $this->device();
                    })
                    ->log('Deleted Multiple');

                // Lưu dữ liệu sang bảng lịch sử xoá
                activity()->withoutLogs(function () use ($table_del_other, $table_other, $column_other, $table, $column, $data, $table_del) {
                    foreach ($data as $item) {
                        self::addInsertDel($item, $table_del);
                    }

                    // Copy bản ghi từ các bảng và lưu vào bảng chứa history, sau đó xoá bản ghi
                    foreach ($table as $key => $value) {
                        self::insertDel('', $column, $key, $value, 'Multiple');
                    }

                    // Column khoá ngoại khác với khoá ngoại bên trên
                    if ($column_other != null) {
                        self::insertDel('', $column_other, $table_other, $table_del_other, 'Multiple');
                    }
                });

                // Xoá
                $result->delete();
            });

            return response()->json(['code' => 200,
                'message' => 'success'], 200);

        } catch (Exception $err) {
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return response()->json(['code' => 500,
                'message' => 'fail'], 500);
        }
    }
}
