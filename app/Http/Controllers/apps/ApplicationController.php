<?php

namespace App\Http\Controllers\apps;

use App\DataTables\ApplicationDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Application\ApplicationFormRequest;
use App\Http\Requests\Application\UpdateApplicationFormRequest;
use App\Http\Services\Application\ApplicationService;
use App\Models\Application;
use App\Traits\DeleteMultipleTrait;
use App\Traits\DeleteTrait;
use App\Traits\LogShowTrait;
use App\Traits\LogViewTrait;
use App\Traits\StatusActiveTrait;
use App\Traits\StatusBlockTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    use DeleteTrait, DeleteMultipleTrait, StatusActiveTrait, StatusBlockTrait, LogShowTrait, LogViewTrait;

    private ApplicationService $applicationService;
    private Application $application;
    private $name = 'application';

    public function __construct(ApplicationService $applicationService, Application $application)
    {
        $this->applicationService = $applicationService;
        $this->application = $application;
    }

    public function index(ApplicationDataTable $dataTable)
    {
        $this->logView($this->name, 'List');
        return $dataTable->render('admin.application.list', [
            'title' => 'Danh sách ứng dụng live',
            'categories' => $this->applicationService->getParent()
        ]);
    }

    public function create()
    {
        $this->logView($this->name, 'List');
        return view('admin.application.add', [
            'title' => 'Thêm ứng dụng live mới',
        ]);
    }

    public function store(ApplicationFormRequest $request)
    {
        $result = $this->applicationService->create($request);
        if ($result) {
            return redirect('app/list');
        }

        return redirect()->back()->withInput();
    }

    public function show(Application $id)
    {
        $this->logShow($this->name, $id);
        return view('admin.application.edit', [
            'title' => 'Chỉnh sửa ứng dụng live: ' . $id->name,
            'application' => $id,
        ]);
    }

    public function update(Application $id, UpdateApplicationFormRequest $request)
    {
        $result = $this->applicationService->update($request, $id);
        if ($result) {
            return redirect('app/list');
        }

        return redirect()->back()->withInput();
    }

    public function destroy(Application $id): JsonResponse
    {
        return $this->deleteTrait($id);
    }

    // Xoá nhiều bản ghi cùng lúc
    public function deleteMultiple(): JsonResponse
    {
        return $this->deleteMultipleTrait($this->application, $this->name);
    }

    // Kích hoạt status
    public function active(Application $id): JsonResponse
    {
        return $this->statusActiveTrait($id);
    }

    // Vô hiệu hoá status
    public function deactive(Application $id): JsonResponse
    {
        return $this->statusBlockTrait($id);
    }

}
