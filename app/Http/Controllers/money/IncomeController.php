<?php

namespace App\Http\Controllers\money;

use App\DataTables\IncomeDataTable;
use App\Http\Requests\Income\IncomeFormRequest;
use App\Models\Income;
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

class IncomeController extends Controller
{
    use DeleteTrait, DeleteMultipleTrait, StatusActiveTrait, StatusBlockTrait, LogShowTrait, LogViewTrait;

    private Income $income;
    private $name = 'income';

    public function __construct(Income $income)
    {
        $this->income = $income;
    }

    public function index(IncomeDataTable $dataTable)
    {
        $category = DB::table('income_categories')->select('id', 'name')->get();
        return $dataTable->render('admin.income.list', [
            'title' => 'Danh sách thu nhập',
            'category' => $category
        ]);
    }

    public function store(IncomeFormRequest $request)
    {
        try {
            Income::create($request->input());
            return response()->json(['code' => 200, 'message' => 'success'], 200);

        } catch (Exception $err) {
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return response()->json(['code' => 500, 'message' => 'fail'], 500);
        }
    }

    public function show(Income $id): JsonResponse
    {
        return response()->json($id);
    }

    public function update(Income $id, IncomeFormRequest $request): JsonResponse
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

    public function destroy(Income $id): JsonResponse
    {
        return $this->deleteTrait($id);
    }

    // Xoá nhiều bản ghi cùng lúc
    public function deleteMultiple(): JsonResponse
    {
        return $this->deleteMultipleTrait($this->income, $this->name);
    }
}
