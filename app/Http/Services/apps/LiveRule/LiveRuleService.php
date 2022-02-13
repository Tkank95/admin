<?php

namespace App\Http\Services\apps\LiveRule;

use App\Models\Live_Rule;
use App\Models\Promote;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class LiveRuleService
{
    public function create($request): bool
    {
        try {
            DB::transaction(function () use ($request) {
                $this->updateStatus($request->app_id);
                Live_Rule::create($request->all());
            });

            Session::flash('success', 'Thêm quy định live thành công.');

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

            Session::flash('success', 'Cập nhật quy định live '. $id->ruleApp->name.' thành công.');

        } catch (Exception $err) {
            Session::flash('error', $err->getMessage());
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }

        return true;
    }

    protected function updateStatus ($id): int
    {
        return DB::table('live_rule')->where([['app_id','=', $id], ['status','=', 1]])->update(['status' => 0]);
    }
}
