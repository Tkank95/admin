<?php

namespace App\Http\Controllers\apps;

use App\DataTables\PolicyDataTable;
use App\Http\Requests\Policy\PolicyFormRequest;
use App\Http\Services\Policy\PolicyService;
use App\Models\Live_Rule;
use App\Models\Policy;
use App\Traits\LogViewTrait;
use App\Traits\StatusActiveTrait;
use App\Traits\StatusBlockTrait;
use Illuminate\Http\JsonResponse;

class PolicyController extends Controller
{
    use LogViewTrait, StatusActiveTrait, StatusBlockTrait;

    private AdminController $adminController;
    private PolicyService $policyService;
    private Policy $policy;
    private $name = 'policy';

    public function __construct(PolicyService $policyService, Policy $policy, AdminController $adminController)
    {
        $this->adminController = $adminController;
        $this->policyService = $policyService;
        $this->policy = $policy;
    }

    public function index(PolicyDataTable $dataTable)
    {
        $this->logView($this->name, 'List');
        return $dataTable->render('admin.policy.list', [
            'title' => 'Chính sách lương',
            'applications' => $this->adminController->getApp()
        ]);
    }

    public function create()
    {
        $this->logView($this->name, 'Create');
        return view('admin.policy.add', [
            'title' => 'Thêm chính sách lương mới'
        ]);
    }

    public function store(PolicyFormRequest $request)
    {
        $result = $this->policyService->create($request);
        if ($result) {
            return redirect('policy/list');
        }

        return redirect()->back()->withInput();
    }

    public function show(Policy $id)
    {
//        $this->logShow($this->name, $id);
        return view('admin.policy.edit', [
            'title' => 'Chỉnh sửa chính sách lương',
            'policy' => $id,
        ]);
    }

    public function update(Policy $id, PolicyFormRequest $request)
    {
        $result = $this->policyService->update($id, $request);
        if ($result) {
            return redirect('policy/list');
        }

        return redirect()->back()->withInput();
    }

    public function destroy(Policy $id): JsonResponse
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

    public function idol(Policy $id)
    {
        $this->logView($this->name, 'Idol');
        return view('admin.policy.idol', [
            'title' => 'Idol ' . $id->policyApp->name,
            'policyIdol' => $id
        ]);
    }

    public function agency(Policy $id)
    {
        $this->logView($this->name, 'Agency');
        return view('admin.policy.agency', [
            'title' => 'Agency ' . $id->policyApp->name,
            'policyAgency' => $id
        ]);
    }

    // Kích hoạt status
    public function active(Policy $id): JsonResponse
    {
        return $this->statusActiveTrait($id);
    }

    // Vô hiệu hoá status
    public function deactive(Policy $id): JsonResponse
    {
        return $this->statusBlockTrait($id);
    }
}
