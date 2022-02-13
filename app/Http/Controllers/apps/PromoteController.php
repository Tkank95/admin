<?php

namespace App\Http\Controllers\apps;

use App\DataTables\PromoteDataTable;
use App\Http\Requests\Promote\PromoteFormRequest;
use App\Http\Requests\Promote\UpdatePromoteFormRequest;
use App\Http\Services\Promote\PromoteService;
use App\Models\Promote;
use App\Traits\LogViewTrait;
use App\Traits\StatusActiveTrait;
use App\Traits\StatusBlockTrait;
use Illuminate\Http\JsonResponse;

class PromoteController extends Controller
{
    use LogViewTrait, StatusActiveTrait, StatusBlockTrait;

    private AdminController $adminController;
    private PromoteService $promoteService;
    private Promote $promote;
    private $name = 'promote';

    public function __construct(PromoteService $promoteService, Promote $promote, AdminController $adminController)
    {
        $this->adminController = $adminController;
        $this->promoteService = $promoteService;
        $this->promote = $promote;
    }

    public function index(PromoteDataTable $dataTable)
    {
        $this->logView($this->name, 'List');
        return $dataTable->render('admin.promote.list', [
            'title' => 'Đề xuất ứng dụng',
            'applications' => $this->adminController->getApp()
        ]);
    }

    public function create()
    {
        $this->logView($this->name, 'Create');
        return view('admin.promote.add', [
            'title' => 'Thêm đề xuất ứng dụng mới'
        ]);
    }

    public function store(PromoteFormRequest $request)
    {
        $result = $this->promoteService->create($request);
        if ($result) {
            return redirect('promote/list');
        }

        return redirect()->back()->withInput();
    }

    public function show(Promote $id)
    {
//        $this->logShow($this->name, $id);
        return view('admin.promote.edit', [
            'title' => 'Chỉnh sửa đề xuất ứng dụng',
            'promote' => $id,
        ]);
    }

    public function update(Promote $id, UpdatePromoteFormRequest $request)
    {
        $result = $this->promoteService->update($id, $request);
        if ($result) {
            return redirect('promote/list');
        }

        return redirect()->back()->withInput();
    }

    public function destroy(Promote $id): JsonResponse
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

    // Kích hoạt status
    public function active(Promote $id): JsonResponse
    {
        return $this->statusActiveTrait($id);
    }

    // Vô hiệu hoá status
    public function deactive(Promote $id): JsonResponse
    {
        return $this->statusBlockTrait($id);
    }
}
