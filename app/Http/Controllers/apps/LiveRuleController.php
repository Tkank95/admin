<?php

namespace App\Http\Controllers\apps;

use App\DataTables\LiveRuleDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\LiveRule\LiveRuleFormRequest;
use App\Http\Services\LiveRule\LiveRuleService;
use App\Models\Live_Rule;
use App\Traits\LogViewTrait;
use App\Traits\StatusActiveTrait;
use App\Traits\StatusBlockTrait;
use Illuminate\Http\JsonResponse;

class LiveRuleController extends Controller
{
    use LogViewTrait, StatusBlockTrait, StatusActiveTrait;

    private AdminController $adminController;
    private LiveRuleService $liveRuleService;
    private Live_Rule $live_Rule;
    private $name = 'live_rule';

    public function __construct(LiveRuleService $liveRuleService, Live_Rule $live_Rule, AdminController $adminController)
    {
        $this->adminController = $adminController;
        $this->liveRuleService = $liveRuleService;
        $this->live_Rule = $live_Rule;
    }

    public function index(LiveRuleDataTable $dataTable)
    {
        $this->logView($this->name, 'List');
        return $dataTable->render('admin.live_rule.list', [
            'title' => 'Quy định live',
            'applications' => $this->adminController->getApp()
        ]);
    }

    public function create()
    {
        $this->logView($this->name, 'Create');
        return view('admin.live_rule.add', [
            'title' => 'Thêm quy định live mới'
        ]);
    }

    public function store(LiveRuleFormRequest $request)
    {
        $result = $this->liveRuleService->create($request);
        if ($result) {
            return redirect('rule/list');
        }

        return redirect()->back()->withInput();
    }

    public function show(Live_Rule $id)
    {
//        $this->logShow($this->name, $id);
        return view('admin.live_rule.edit', [
            'title' => 'Chỉnh sửa quy định live',
            'rule' => $id,
        ]);
    }

    public function update(Live_Rule $id, LiveRuleFormRequest $request)
    {
        $result = $this->liveRuleService->update($id, $request);
        if ($result) {
            return redirect('rule/list');
        }

        return redirect()->back()->withInput();
    }

    public function destroy(Live_Rule $id): JsonResponse
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

    public function rule(Live_Rule $id)
    {
        $this->logView('rule', 'Rule');
        return view('admin.live_rule.rule', [
            'title' => 'Rule ' . $id->name,
            'rule' => $id
        ]);
    }

    // Kích hoạt status
    public function active(Live_Rule $id): JsonResponse
    {
        return $this->statusActiveTrait($id);
    }

    // Vô hiệu hoá status
    public function deactive(Live_Rule $id): JsonResponse
    {
        return $this->statusBlockTrait($id);
    }
}
