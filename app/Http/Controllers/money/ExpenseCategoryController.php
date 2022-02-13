<?php

namespace App\Http\Controllers\money;

use App\DataTables\ExpenseCategoryDataTable;
use App\Http\Requests\Expense\ExpenseCategoryFormRequest;
use App\Models\ExpenseCategory;
use App\Traits\DeleteMultipleTrait;
use App\Traits\DeleteTrait;
use App\Traits\LogShowTrait;
use App\Traits\LogViewTrait;
use App\Traits\StatusActiveTrait;
use App\Traits\StatusBlockTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class ExpenseCategoryController extends Controller
{
    use DeleteTrait, DeleteMultipleTrait, StatusActiveTrait, StatusBlockTrait, LogShowTrait, LogViewTrait;

    private ExpenseCategory $expenseCategory;
    private $name = 'expense_category';

    public function __construct(ExpenseCategory $expenseCategory)
    {
        $this->expenseCategory = $expenseCategory;
    }

    public function index(ExpenseCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.expense.category.list', ['title' => 'Loại chi phí']);
    }

    public function store(ExpenseCategoryFormRequest $request)
    {
        try {
            ExpenseCategory::create(['name' => $request->name]);
            return response()->json(['code' => 200, 'message' => 'success'], 200);

        } catch (Exception $err) {
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return response()->json(['code' => 500, 'message' => 'fail'], 500);
        }
    }

    public function show(ExpenseCategory $id): JsonResponse
    {
        return response()->json(['id' => $id->id, 'name' => $id->name]);
    }

    public function update(ExpenseCategory $id, ExpenseCategoryFormRequest $request): JsonResponse
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

    public function destroy(ExpenseCategory $id): JsonResponse
    {
        return $this->deleteTrait($id);
    }

    // Xoá nhiều bản ghi cùng lúc
    public function deleteMultiple(): JsonResponse
    {
        return $this->deleteMultipleTrait($this->Data_Live, $this->name);
    }
}
