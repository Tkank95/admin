<?php

namespace App\Http\Services\data;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class DataLiveService
{
    public function update($id, $request): bool
    {
        try {
            DB::transaction(function () use ($id, $request) {
                $id->fill($request->all());
                $id->save();
            });

        } catch (Exception $err) {
            Session::flash('error', $err->getMessage());
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }

        return true;
    }

}
