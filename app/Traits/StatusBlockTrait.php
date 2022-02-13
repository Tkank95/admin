<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

trait StatusBlockTrait
{
    public function statusBlockTrait($id): JsonResponse
    {
        try {
            $id->update(['status' => 0]);
            return response()->json([
                'code' => 200,
                'message' => 'success'
            ], 200);

        } catch (Exception $err) {
            Log::info($err->getMessage() . ' Line: ' . $err->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }
}
