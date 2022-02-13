<?php

namespace App\Http\Services\members\Bank;

use App\Models\Bank;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class BankService
{
    // Lấy email user
    public function getEmail(): Collection
    {
        return DB::table('users')->select('id', 'email')->get();
    }

    public function create($request): bool
    {
        // Nếu đã có thông tin từ trước thì sẽ update mà không tạo mới
        $bank = Bank::where('user_id', $request->user_id)->first();
        $input = $request->all();
        try {
            if ($bank) {
                // Cập nhật
                $bank->fill($input);
                $bank->save();

                Session::flash('success', 'Cập nhật thành công: ' . $bank->name);
            } else {
                // Tạo mới
                Bank::create($input);
                Session::flash('success', 'Tạo Bank User: ' . $request->name . ' Thành Công');
            }
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
            $id->fill($request->all());
            $id->save();

            Session::flash('success', 'Cập nhật thành công: ' . $id->name);
        } catch (Exception $err) {
            Session::flash('error', 'Có lỗi vui lòng thử lại');
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }
        return true;
    }
}
