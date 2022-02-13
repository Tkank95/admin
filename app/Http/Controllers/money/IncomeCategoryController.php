<?php

namespace App\Http\Controllers\money;

use App\DataTables\IncomeCategoryDataTable;
use App\Http\Requests\Income\IncomeCategoryFormRequest;
use App\Models\IncomeCategory;
use App\Traits\DeleteMultipleTrait;
use App\Traits\DeleteTrait;
use App\Traits\LogShowTrait;
use App\Traits\LogViewTrait;
use App\Traits\StatusActiveTrait;
use App\Traits\StatusBlockTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class IncomeCategoryController extends Controller
{
    use DeleteTrait, DeleteMultipleTrait, StatusActiveTrait, StatusBlockTrait, LogShowTrait, LogViewTrait;

    private IncomeCategory $incomeCategory;
    private $name = 'income_category';

    public function __construct(IncomeCategory $incomeCategory)
    {
        $this->incomeCategory = $incomeCategory;
    }

    public function index(IncomeCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.income.category.list', ['title' => 'Loại thu nhập']);
    }

    public function store(IncomeCategoryFormRequest $request)
    {
        try {
            IncomeCategory::create(['name' => $request->name]);
            return response()->json(['code' => 200, 'message' => 'success'], 200);

        } catch (Exception $err) {
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return response()->json(['code' => 500, 'message' => 'fail'], 500);
        }
    }

    public function show(IncomeCategory $id): JsonResponse
    {
        return response()->json(['id' => $id->id, 'name' => $id->name]);
    }

    public function update(IncomeCategory $id, IncomeCategoryFormRequest $request): JsonResponse
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

    public function destroy(IncomeCategory $id): JsonResponse
    {
        return $this->deleteTrait($id);
    }

    // Xoá nhiều bản ghi cùng lúc
    public function deleteMultiple(): JsonResponse
    {
        return $this->deleteMultipleTrait($this->Data_Live, $this->name);
    }
}
