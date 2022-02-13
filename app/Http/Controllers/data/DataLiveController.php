<?php

namespace App\Http\Controllers\data;

use App\DataTables\DataLiveDataTable;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Controller;
use App\Http\Requests\data\ApplyJob\ApplyJobFormRequest;
use App\Http\Requests\Data\DataLiveFormRequest;
use App\Http\Services\Data\DataLiveService;
use App\Models\data\Data_Live;
use App\Traits\DeleteMultipleTrait;
use App\Traits\DeleteTrait;
use App\Traits\LogShowTrait;
use App\Traits\LogViewTrait;
use App\Traits\StatusActiveTrait;
use App\Traits\StatusBlockTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class DataLiveController extends Controller
{
    use DeleteTrait, DeleteMultipleTrait, StatusActiveTrait, StatusBlockTrait, LogShowTrait, LogViewTrait;

    private DataLiveService $dataLiveService;
    private AdminController $adminController;
    private Data_Live $data_live;
    private $name = 'data_Live';

    public function __construct(DataLiveService $dataLiveService, Data_Live $data_live, AdminController $adminController)
    {
        $this->adminController = $adminController;
        $this->dataLiveService = $dataLiveService;
        $this->data_live = $data_live;
    }

    public function index(DataLiveDataTable $dataTable)
    {
        return $dataTable->render('admin.data.live.list', [
            'title' => 'Data live stream',
            'users' => $this->adminController->getUser(),
            'applications' => $this->adminController->getApp()
        ]);
    }

    public function create()
    {
        return view('admin.data.live.add', [
            'title' => 'Thêm dữ liệu live',
//            'email' => $this->dataLiveService->getEmail(),
//            'agency' => $this->dataLiveService->getAgency(),
        ]);
    }

    public function store(ApplyJobFormRequest $request)
    {
        $result = $this->dataLiveService->create($request);
        if ($result) {
            return redirect('job/list');
        }

        return redirect()->back()->withInput();
    }

//    public function show(Data_Live $id)
//    {
//        return view('admin.Data_Live.edit', [
//            'title' => 'Chỉnh Sửa Apply Job: ' . $id->name,
//            'jobs' => $id,
//            'user' => $this->applyJobService->getUser($id->user_id),
//            'email' => $this->applyJobService->getEmail(),
//            'agency' => $this->applyJobService->getAgency(),
//        ]);
//    }


    public function update(Data_Live $id, DataLiveFormRequest $request)
    {
        try {
            $id->fill($request->input());
            $id->save();
            return response()->json([
                'code' => 200,
                'id_in_app' => $id->dataLive->id_in_app,
                'message' => 'success'
            ], 200);

        } catch (Exception $err) {
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return response()->json([
                'code' => 500,
                'message' => 'fail'
            ], 500);
        }
    }

    public function destroy(Data_Live $id): JsonResponse
    {
        return $this->deleteTrait($id);
    }

    // Xoá nhiều bản ghi cùng lúc
    public function deleteMultiple(): JsonResponse
    {
        return $this->deleteMultipleTrait($this->Data_Live, $this->name);
    }

}
