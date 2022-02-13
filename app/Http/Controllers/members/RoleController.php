<?php

namespace App\Http\Controllers\members;

use App\DataTables\RoleDataTable;
use App\Http\Requests\Role\RoleFormRequest;
use App\Http\Services\Role\RoleService;
use App\Models\Role;
use App\Traits\DeleteMultipleTrait;
use App\Traits\DeleteTrait;
use App\Traits\LogShowTrait;
use App\Traits\LogViewTrait;
use Illuminate\Http\JsonResponse;

class RoleController extends Controller
{
    use DeleteTrait, DeleteMultipleTrait, LogViewTrait, LogShowTrait;

    private RoleService $roleService;
    private Role $role;
    private $name = 'role';

    public function __construct(Role $role, RoleService $roleService)
    {
        $this->roleService = $roleService;
        $this->role = $role;
    }

    public function index(RoleDataTable $dataTable)
    {
        $this->logView($this->name, 'List');
        return $dataTable->render('admin.role.list', [
            'title' => 'Danh Sách Role'
        ]);
    }

    public function create()
    {
        $this->logView($this->name, 'Create');
        return view('admin.role.add', [
            'title' => 'Thêm Role',
            'permisionParent' => $this->roleService->permisionParent()
        ]);
    }

    public function store(RoleFormRequest $request)
    {
        $result = $this->roleService->create($request);
        if ($result) {
            return redirect('role/list');
        }

        return redirect()->back()->withInput();
    }

    public function show(Role $id)
    {
        $this->logShow($this->name, $id);
        $permissionChecked = $id->permissions;
        return view('admin.role.edit', [
            'title' => 'Edit Role ' . $id->name,
            'roles' => $id,
            'permissionChecked' => $permissionChecked,
            'permisionParent' => $this->roleService->permisionParent()
        ]);
    }

    public function update(Role $id, RoleFormRequest $request)
    {
        $result = $this->roleService->update($id, $request);
        if ($result) {
            return redirect('role/list');
        }

        return redirect()->back()->withInput();
    }

    public function destroy(Role $id): JsonResponse
    {
        return $this->deleteTrait($id);
    }

    // Xoá nhiều bản ghi cùng lúc
    public function deleteMultiple(): JsonResponse
    {
        return $this->deleteMultipleTrait($this->role, $this->name);
    }
}
