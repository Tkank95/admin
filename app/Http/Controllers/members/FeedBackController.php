<?php

namespace App\Http\Controllers\members;

use App\DataTables\BankDataTable;
use App\DataTables\FeedBackDataTable;
use App\Http\Requests\Bank\BankFormRequest;
use App\Http\Requests\FeedBack\FeedBackFormRequest;
use App\Http\Services\Bank\BankService;
use App\Models\Bank;
use App\Models\Feedback;
use App\Traits\DeleteMultipleTrait;
use App\Traits\DeleteTrait;
use App\Traits\LogShowTrait;
use App\Traits\LogViewTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FeedBackController extends Controller
{
    use DeleteMultipleTrait, DeleteTrait, LogViewTrait, LogShowTrait;

    private AdminController $adminController;
    private BankService $bankService;
    private Bank $bank;
    private $name = 'bank';

    public function __construct(BankService $bankService, AdminController $adminController, Bank $bank)
    {
        $this->adminController = $adminController;
        $this->bankService = $bankService;
        $this->bank = $bank;
    }

    public function index(FeedBackDataTable $dataTable)
    {
        $this->logView($this->name, 'List');
        return $dataTable->render('admin.feedback.list', [
            'title' => 'Góp ý, phản hồi',
            'users' => $this->adminController->getUser()
        ]);
    }

    public function create()
    {
        $this->logView($this->name, 'Create');
        return view('admin.feedback.add', [
            'title' => 'Thêm thông tin ngân hàng',
            'user' => $this->bankService->getEmail()
        ]);
    }

    public function store(FeedBackFormRequest $request)
    {
        $result = $this->bankService->create($request);
        if ($result) {
            return redirect('feedback/list');
        }

        return redirect()->back()->withInput();
    }

    public function show(Feedback $id)
    {
        $this->logShow($this->name, $id);
        return response()->json($id);
    }

    public function update(Feedback $id, FeedBackFormRequest $request)
    {
        try {
            $id->update(['result' => $request->result]);

            return response()->json([
                'code' => 200,
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

    public function destroy(Bank $id): JsonResponse
    {
        return $this->deleteTrait($id);
    }

    // Xoá nhiều thông tin ngân hàng của user cùng lúc
    public function deleteMultiple(): JsonResponse
    {
        return $this->deleteMultipleTrait($this->bank, $this->name);
    }

}
