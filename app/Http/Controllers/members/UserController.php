<?php

namespace App\Http\Controllers\members;

use App\DataTables\UserDataTable;
use App\Http\Requests\User\UserFormRequest;
use App\Http\Requests\User\UserUpdateFormRequest;
use App\Http\Services\User\UserService;
use App\Models\members\User;
use App\Traits\DeleteMultipleTrait;
use App\Traits\DeleteTrait;
use App\Traits\LogShowTrait;
use App\Traits\LogViewTrait;
use App\Traits\StatusActiveTrait;
use App\Traits\StatusBlockTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use DeleteTrait, DeleteMultipleTrait, StatusActiveTrait,
        StatusBlockTrait, LogViewTrait, LogShowTrait;

    private UserService $userService;
    private User $user;
    private $name = 'user';

    public function __construct(UserService $userService, User $user)
    {
        $this->userService = $userService;
        $this->user = $user;
    }

    public function index(UserDataTable $dataTable)
    {
        $this->logView($this->name, 'List');
        return $dataTable->render('admin.user.list', [
            'title' => 'Danh Sách User'
        ]);
    }

    public function create()
    {
        $this->logView($this->name, 'Create');
        return view('admin.user.add', [
            'title' => 'Thêm User mới',
            'roles' => $this->userService->getRole()
        ]);
    }

    public function store(UserFormRequest $request)
    {
        $result = $this->userService->create($request);
        if ($result) {
            return redirect('user/list');
        }

        return redirect()->back()->withInput();
    }

    public function show(User $id)
    {
        $this->logShow($this->name, $id);
        $roleOfUser = $id->roles;
        return view('admin.user.edit', [
            'title' => 'Chỉnh Sửa User: ' . $id->name,
            'users' => $id,
            'roles' => $this->userService->getRole(),
            'roleOfUser' => $roleOfUser
        ]);
    }

    public function update(User $id, UserUpdateFormRequest $request)
    {
        $result = $this->userService->update($id, $request);
        if ($result) {
            return redirect('user/list');
        }

        return redirect()->back()->withInput();
    }

    public function destroy(User $id): JsonResponse
    {
        return $this->deleteTrait($id);
    }

    // Xoá nhiều bản ghi cùng lúc
    public function deleteMultiple(): JsonResponse
    {
        return $this->deleteMultipleTrait($this->user, $this->name, 'user_id', [
            'Member_info' => 'member_info_del',
            'New_Tutorials' => 'New_Tutorials_del',
            'banks' => 'banks_del',
            'apply_jobs' => 'apply_jobs_del',
            'comments' => 'comments_del',
            'role_user' => 'role_user_del'
        ], 'users_del', 'causer_id', 'activity_log', 'activity_log_del');
    }

    public function showBan(User $id): JsonResponse
    {
        return response()->json($id);
    }

    // Khoá hoặc mở khoá tài khoản
    public function banned(User $id, Request $request): JsonResponse
    {
        $ban = $this->userService->ban($id, $request);
        if ($ban) {
            return response()->json(['error' => false, 'message' => 'Update Banned thành công']);
        }
        return response()->json(['error' => true, 'message' => 'Failed']);
    }

    // Kích hoạt status
    public function active(User $id): JsonResponse
    {
        return $this->statusActiveTrait($id);
    }

    // Vô hiệu hoá status
    public function deactive(User $id): JsonResponse
    {
        return $this->statusBlockTrait($id);
    }

}
