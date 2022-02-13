<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait InsertDel
{
    protected static function addInsertDel($model, $table_del)
    {
        $insertOldDel = $model->replicate();
        $insertOldDel->setTable($table_del);
        $insertOldDel->id = $model->id;
        $insertOldDel->user_id_del = auth()->id();
        $insertOldDel->created_at = $model->created_at;
        $insertOldDel->updated_at = $model->updated_at;
        $insertOldDel->create_time = now();
        $insertOldDel->timestamps = false;
        $insertOldDel->save();
    }

    protected static function insertDel($id, $column, $table, $table_del, $type)
    {
        if ($type == '') {
            $query = DB::table($table)->where($column, $id);
        } else {
            $query = DB::table($table)->whereIn($column, explode(",", request('ids')));
        }

        // Giá trị mặc định ban đầu
        $data = '';
        $count = 0;

        $query->chunkById(100, function ($get) use ($table_del, &$data, &$count) {
            // Chuyển đổi json $get sang mảng, và tăng giá trị biến count
            $arr = json_decode($get);
            $count += count($get);

            // Thêm thông tin user xoá và thời gian xoá vào mảng
            foreach ($arr as $item) {
                $add = $item;
                $add->user_id_del = auth()->id();
                $add->create_time = now()->format('Y-m-d H:i:s');

                // Chuyển đổi mảng sang json, mục đích để nối thêm dữ liệu user xoá và thời gian xoá
                $data = json_encode($arr);
            }
            DB::table($table_del)->insert(json_decode($data, true));
        });

        if ($count > 0) {
            $query->delete();
        }
    }
}
