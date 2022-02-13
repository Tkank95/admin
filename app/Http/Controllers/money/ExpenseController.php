<?php

namespace App\Http\Controllers\money;

use App\DataTables\ExpenseDataTable;
use App\Http\Requests\Expense\ExpenseFormRequest;
use App\Models\Expense;
use App\Traits\DeleteMultipleTrait;
use App\Traits\DeleteTrait;
use App\Traits\LogShowTrait;
use App\Traits\LogViewTrait;
use App\Traits\StatusActiveTrait;
use App\Traits\StatusBlockTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ExpenseController extends Controller
{
    use DeleteTrait, DeleteMultipleTrait, StatusActiveTrait, StatusBlockTrait, LogShowTrait, LogViewTrait;

    private Expense $expense;
    private $name = 'expense';

    public function __construct(Expense $expense)
    {
        $this->expense = $expense;
    }

    public function index(ExpenseDataTable $dataTable)
    {
        $category = DB::table('expense_categories')->select('id', 'name')->get();
        return $dataTable->render('admin.expense.list', [
            'title' => 'Danh sách chi phí thanh toán',
            'category' => $category
        ]);
    }

    public function store(ExpenseFormRequest $request)
    {
        try {
            Expense::create($request->input());
            return response()->json(['code' => 200, 'message' => 'success'], 200);

        } catch (Exception $err) {
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return response()->json(['code' => 500, 'message' => 'fail'], 500);
        }
    }

    public function show(Expense $id): JsonResponse
    {
        return response()->json($id);
    }

    public function update(Expense $id, ExpenseFormRequest $request): JsonResponse
    {
        try {
            $id->fill($request->input());
            $id->save();
            return response()->json(['code' => 200, 'message' => 'success'], 200);

        } catch (Exception $err) {
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return response()->json(['code' => 500, 'message' => 'fail'], 500);
        }
    }

    public function destroy(Expense $id): JsonResponse
    {
        return $this->deleteTrait($id);
    }

    // Xoá nhiều bản ghi cùng lúc
    public function deleteMultiple(): JsonResponse
    {
        return $this->deleteMultipleTrait($this->expense, $this->name);
    }
}
