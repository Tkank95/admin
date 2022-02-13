<?php

namespace App\Http\Controllers\members;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class CheckValidation extends Controller
{
    public function checkEmail(Request $request): JsonResponse
    {
        $validator = Validator::make($request->only(['email']), ['email' => 'required|email:rfc,dns,filter,strict,spoof|max:50|unique:users,email']);

        // json is null
        if ($validator->fails()) {
            return Response::json(array('msg' => 'true'));
        }
        return Response::json(array('msg' => 'false'));

    }

    public function checkUsername(Request $request): JsonResponse
    {
        $validator = Validator::make($request->only(['username']), ['username' => 'required|min:6|max:15|alpha_dash|unique:users,username']);

        // json is null
        if ($validator->fails()) {
            return Response::json(array('msg' => 'true'));
        }
        return Response::json(array('msg' => 'false'));
    }
}
