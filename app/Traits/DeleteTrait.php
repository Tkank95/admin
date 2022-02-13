<?php

namespace App\Traits;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

trait DeleteTrait
{
    public function deleteTrait($id): JsonResponse
    {
        try {
            // Xoá ảnh nếu có
//            if ($image_type != '') {
//                $path = str_replace('storage', 'public', $id->$image_type);
//                Storage::delete($path);
//            }

            // Xoá
            $id->delete();

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
