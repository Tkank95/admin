<?php

namespace App\Http\Services\members\Role;

use App\Models\Permission;
use App\Models\Role;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class RoleService
{

    public function permisionParent()
    {
        return Permission::where('parent_id', 0)->get();
    }

    public function create($request)
    {
        try {
            DB::beginTransaction();
            $role = Role::create($request->input());
            $role->permissions()->attach($request->permision_id);
            DB::commit();

            Session::flash('success', 'Thêm role: '.$request->name.' Thành Công');
        } catch (Exception $err) {
            DB::rollBack();
            Session::flash('error', $err->getMessage());
            Log::error($err->getMessage().' Line: '.$err->getLine());
            return false;
        }

        return true;
    }

    public function update($role, $request)
    {
        try {
            DB::beginTransaction();
            $role->fill($request->input());
            $role->save();
            $role->permissions()->sync($request->permision_id);
            DB::commit();

            Session::flash('success', 'Update role: '.$request->name.' Thành Công');
        } catch (Exception $err) {
            DB::rollBack();
            Session::flash('error', $err->getMessage());
            Log::error($err->getMessage().' Line: '.$err->getLine());
            return false;
        }

        return true;
    }
}
