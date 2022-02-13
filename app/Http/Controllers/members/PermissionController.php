<?php

namespace App\Http\Controllers\members;

use App\Http\Controllers\apps\Controller;
use App\Http\Requests\Permission\PermissionFormRequest;
use App\Http\Services\Permission\PermissionService;
use App\Models\Permission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    protected PermissionService $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }


    public function create()
    {
        return view('admin.permission.add', [
            'title' => 'Thêm Permission',
        ]);
    }

    public function store(Request $request)
    {
        try{
            $permission = Permission::create([
                'name' => $request->module_parent,
                'display_name' => $request->module_parent,
                'parent_id' => 0,
                'key_code' => 0
            ]);

            foreach ($request->module_childrent as $value)
            {
                Permission::create([
                    'name' => $value,
                    'display_name' => $value,
                    'parent_id' => $permission->id,
                    'key_code' => $request->module_parent.'_'.$value
                ]);
            }
            Session::flash('success', 'Thêm permission: '.$request->module_parent.' Thành Công');
        } catch (Exception $err) {
            Session::flash('error', $err->getMessage());
            Log::info($err->getMessage() . ' Line: ' . $err->getLine());
            return false;
        }
        return redirect('permission/add');
    }
}
