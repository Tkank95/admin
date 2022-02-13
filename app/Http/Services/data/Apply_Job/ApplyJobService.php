<?php

namespace App\Http\Services\data\Apply_Job;

use App\Models\Apply_Job;
use App\Traits\StorageImageTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ApplyJobService
{
    use StorageImageTrait;

    public function create(Request $request): bool
    {
        $input = $request->input();

        // Lưu ảnh vào thư mục
        $cmndMtUpload = $this->storageTraitUpload($request, 'cmnd_mt', 'cmnd/mt');
        $selfieCmndUpload = $this->storageTraitUpload($request, 'selfie_cmnd', 'cmnd/selfie');
        $selfieUpload = $this->storageTraitUpload($request, 'selfie', 'selfie/idol');
        $cmndMsUpload = $this->storageTraitUpload($request, 'cmnd_ms', 'cmnd/ms');
        $selfieTeamUpload = $this->storageTraitUpload($request, 'selfie_team', 'selfie/team');

        // Lấy đường dẫn link ảnh vừa lưu
        if (!empty($cmndMtUpload)) {
            $input['cmnd_mt'] = $cmndMtUpload['file_path'];
        }
        if (!empty($selfieCmndUpload)) {
            $input['selfie_cmnd'] = $selfieCmndUpload['file_path'];
        }
        if (!empty($selfieUpload)) {
            $input['selfie'] = $selfieUpload['file_path'];
        }
        if (!empty($cmndMsUpload)) {
            $input['cmnd_ms'] = $cmndMsUpload['file_path'];
        }
        if (!empty($selfieTeamUpload)) {
            $input['selfie_team'] = $selfieTeamUpload['file_path'];
        }

        try {
            DB::transaction(function () use ($input) {
                $apply = Apply_Job::create($input);

                // Lưu thông tin vào bảng identityCard
                $apply->identityCard()->create($input);

                // Lưu thông tin vào bảng result
                $apply->resultCast()->create($input);
            });
            Session::flash('success', 'Thêm Đơn đăng ký ID: ' . $input['id_in_app'] . ' thành công');

        } catch (Exception $err) {
            // Lỗi thì xoá ảnh vừa tải lên
            if (!empty($cmndMtUpload)) {
                Storage::delete(str_replace('storage', 'public', $cmndMtUpload['file_path']));
            }
            if (!empty($selfieCmndUpload)) {
                Storage::delete(str_replace('storage', 'public', $cmndMsUpload['file_path']));
            }
            if (!empty($selfieUpload)) {
                Storage::delete(str_replace('storage', 'public', $selfieCmndUpload['file_path']));
            }
            if (!empty($selfieTeamUpload)) {
                Storage::delete(str_replace('storage', 'public', $selfieTeamUpload['file_path']));
            }
            if (!empty($selfieUpload)) {
                Storage::delete(str_replace('storage', 'public', $selfieUpload['file_path']));
            }

            Session::flash('error', 'Thêm Đơn đăng ký Lỗi');
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }

        return true;
    }

    public function update($request, $id): bool
    {
        $input = $request->input();

        // Lưu ảnh vào thư mục
        $cmndMtUpload = $this->storageTraitUpload($request, 'cmnd_mt_img', 'cmnd/mt');
        $selfieCmndUpload = $this->storageTraitUpload($request, 'selfie_cmnd_img', 'cmnd/selfie');
        $selfieUpload = $this->storageTraitUpload($request, 'selfie_img', 'selfie/idol');
        $cmndMsUpload = $this->storageTraitUpload($request, 'cmnd_ms_img', 'cmnd/ms');
        $selfieTeamUpload = $this->storageTraitUpload($request, 'selfie_team_img', 'selfie/team');

        // Lấy đường dẫn link ảnh vừa lưu
        if (!empty($cmndMtUpload)) {
            $input['cmnd_mt'] = $cmndMtUpload['file_path'];
        }
        if (!empty($selfieCmndUpload)) {
            $input['selfie_cmnd'] = $selfieCmndUpload['file_path'];
        }
        if (!empty($selfieUpload)) {
            $input['selfie'] = $selfieUpload['file_path'];
        }
        if (!empty($cmndMsUpload)) {
            $input['cmnd_ms'] = $cmndMsUpload['file_path'];
        }
        if (!empty($selfieTeamUpload)) {
            $input['selfie_team'] = $selfieTeamUpload['file_path'];
        }

        try {
            DB::transaction(function () use ($id, $input) {
                $id->fill($input);
                $id->save();

                // Cập nhật thông tin vào bảng identityCard
                $id->identityCard->update($input);

                // Cập nhật thông tin vào bảng result
                $id->resultCast->update($input);
            });

            Session::flash('success', "Cập nhật Đơn đăng ký ID: $id->id_in_app thành công");

        } catch (Exception $err) {
            // Lỗi thì xoá ảnh vừa tải lên
            if (!empty($cmndMtUpload)) {
                Storage::delete(str_replace('storage', 'public', $cmndMtUpload['file_path']));
            }
            if (!empty($selfieCmndUpload)) {
                Storage::delete(str_replace('storage', 'public', $cmndMsUpload['file_path']));
            }
            if (!empty($selfieUpload)) {
                Storage::delete(str_replace('storage', 'public', $selfieCmndUpload['file_path']));
            }
            if (!empty($selfieTeamUpload)) {
                Storage::delete(str_replace('storage', 'public', $selfieTeamUpload['file_path']));
            }
            if (!empty($selfieUpload)) {
                Storage::delete(str_replace('storage', 'public', $selfieUpload['file_path']));
            }

            Session::flash('error', 'Cập nhật Đơn đăng ký Lỗi');
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }

        return true;
    }

    // Lấy info user theo email
    public function getUser($id): Collection
    {
        return DB::table('users')
            ->join('member_info', 'user_id', '=', 'users.id')
            ->select('users.id', 'users.name', 'users.username', 'users.banned_until',
                DB::raw('(CASE WHEN users.status = "1" THEN "Active" ELSE "Disabled account" END) AS status'),
                DB::raw('(CASE WHEN users.position = "1" THEN "Admin"
                                    WHEN users.position = "2" THEN "Smod"
                                    WHEN users.position = "3" THEN "Mod"
                                    WHEN users.position = "4" THEN "Agency"
                                    ELSE "User" END) AS position'),
                DB::raw('(CASE WHEN member_info.gender = "1" THEN "Nam" ELSE "Nữ" END) AS gender'),
                'member_info.birthday', 'member_info.phone', 'member_info.facebook', 'member_info.team')
            ->where('users.id', $id)->get();
    }

    // Lấy email user
    public function getEmail(): Collection
    {
        return DB::table('users')->select('id', 'email')->get();
    }

    // Lấy team agency
    public function getAgency(): Collection
    {
        return DB::table('member_info')->select('user_id', 'team')->whereNotNull('team')->get();
    }

    // Lấy user đăng ký
    public function filterUser(): Collection
    {
        return DB::table('apply_jobs')->select('apply_jobs.user_id', 'users.username')
            ->join('users', 'apply_jobs.user_id', '=', 'users.id')->groupBy('user_id')->get();
    }

    // Lấy ứng dụng được đăng ký
    public function filterApplication(): Collection
    {
        return DB::table('apply_jobs')->select('apply_jobs.app_id', 'applications.name')
            ->join('applications', 'apply_jobs.app_id', '=', 'applications.id')->groupBy('app_id')->get();
    }
}
