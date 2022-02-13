<?php

namespace App\Http\Controllers\members;

use App\DataTables\IncomeCategoryDataTable;
use App\DataTables\TaskTagDataTable;
use App\Http\Requests\Income\IncomeCategoryFormRequest;
use App\Http\Requests\Task\TaskTagFormRequest;
use App\Models\IncomeCategory;
use App\Models\TaskTag;
use App\Traits\DeleteMultipleTrait;
use App\Traits\DeleteTrait;
use App\Traits\LogShowTrait;
use App\Traits\LogViewTrait;
use App\Traits\StatusActiveTrait;
use App\Traits\StatusBlockTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class TaskTagController extends Controller
{
    use DeleteTrait, DeleteMultipleTrait, StatusActiveTrait, StatusBlockTrait, LogShowTrait, LogViewTrait;

    private TaskTag $taskTag;
    private $name = 'task_tag';

    public function __construct(TaskTag $taskTag)
    {
        $this->taskTag = $taskTag;
    }

    public function index(TaskTagDataTable $dataTable)
    {
        return $dataTable->render('admin.task.category.list', ['title' => 'Thẻ nhiệm vụ']);
    }

    public function store(TaskTagFormRequest $request)
    {
        try {
            TaskTag::create(['name' => $request->name]);
            return response()->json(['code' => 200, 'message' => 'success'], 200);

        } catch (Exception $err) {
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return response()->json(['code' => 500, 'message' => 'fail'], 500);
        }
    }

    public function show(TaskTag $id): JsonResponse
    {
        return response()->json(['id' => $id->id, 'name' => $id->name]);
    }

    public function update(TaskTag $id, TaskTagFormRequest $request): JsonResponse
    {
        try {
            $id->fill(['name' => $request->name]);
            $id->save();
            return response()->json(['code' => 200, 'message' => 'success'], 200);

        } catch (Exception $err) {
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return response()->json(['code' => 500, 'message' => 'fail'], 500);
        }
    }

    public function destroy(TaskTag $id): JsonResponse
    {
        return $this->deleteTrait($id);
    }

    // Xoá nhiều bản ghi cùng lúc
    public function deleteMultiple(): JsonResponse
    {
        return $this->deleteMultipleTrait($this->Data_Live, $this->name);
    }
}
