<?php

namespace App\Http\Services\apps\Policy;

use App\Models\Policy;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PolicyService
{
    public function create($request): bool
    {
        try {
            DB::transaction(function () use ($request) {
                $this->updateStatus($request->app_id);
                Policy::create($request->all());
            });

            Session::flash('success', 'Thêm chính sách lương thành công.');

        } catch (Exception $err) {
            Session::flash('error', $err->getMessage());
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }

        return true;
    }

    public function update($id, $request): bool
    {
        try {
            DB::transaction(function () use ($id, $request) {
                $this->updateStatus($request->app_id);
                $id->fill($request->all());
                $id->save();
            });

            Session::flash('success', 'Cập nhật chính sách lương '. $id->policyApp->name.' thành công.');

        } catch (Exception $err) {
            Session::flash('error', $err->getMessage());
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }

        return true;
    }

    protected function updateStatus ($id): int
    {
        return DB::table('policy')->where([['app_id','=', $id], ['status','=', 1]])->update(['status' => 0]);
    }
}
