<?php

namespace App\Http\Controllers\news;

use App\DataTables\TutorialsDataTable;
use App\Exports\NewsTutorialExport;
use App\Http\Requests\New_Tutorial\NewTutorialFormRequest;
use App\Http\Services\NewTutorial\NewTutorialService;
use App\Models\New_Tutorial;
use App\Traits\DeleteMultipleTrait;
use App\Traits\DeleteTrait;
use App\Traits\LogShowTrait;
use App\Traits\LogViewTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class NewTutorialController extends Controller
{
    use DeleteTrait, DeleteMultipleTrait, LogViewTrait, LogShowTrait;

    private NewTutorialService $tutorialService;
    private New_Tutorial $tutorial;
    private $name = 'new_tutorial';

    public function __construct(NewTutorialService $tutorialService, New_Tutorial $tutorial)
    {
        $this->tutorialService = $tutorialService;
        $this->tutorial = $tutorial;
    }

    // Danh sách tin tức
    public function index(TutorialsDataTable $dataTable)
    {
        $this->logView($this->name, 'List');
        return $dataTable->render('admin.new_tutorial.list', [
            'title' => 'Danh Sách Tin Tức',
            'users' => $this->tutorialService->getUser(),
            'apps' => $this->tutorialService->getApplication()
        ]);
    }

    // Mở trang thêm mới tin tức
    public function create()
    {
        $this->logView($this->name, 'Create');
        return view('admin.new_tutorial.add', [
            'title' => 'Thêm Tin tức mới',
        ]);
    }

    // Lưu tin tức vào database
    public function store(NewTutorialFormRequest $request)
    {
        $result = $this->tutorialService->create($request);
        if ($result) {
            return redirect('news/list');
        }

        return redirect()->back()->withInput();
    }

    // Mở trang sửa tin tức
    public function show(New_Tutorial $id)
    {
        $this->logShow($this->name, $id);
        return view('admin.new_tutorial.edit', [
            'title' => 'Chỉnh Sửa tin tức: ' . $id->title,
            'news' => $id,
            'category' => $this->tutorialService->getApplication()
        ]);
    }

    public function update(New_Tutorial $id, NewTutorialFormRequest $request)
    {
        $result = $this->tutorialService->update($request, $id);
        if ($result) {
            return redirect('news/list');
        }

        return redirect()->back()->withInput();
    }

    public function destroy(New_Tutorial $id): JsonResponse
    {
        return $this->deleteTrait($id);
    }

    // Xoá nhiều bản ghi cùng lúc
    public function deleteMultiple(): JsonResponse
    {
        return $this->deleteMultipleTrait($this->tutorial, $this->name);
    }

    public function export(): BinaryFileResponse
    {
        return Excel::download(new NewsTutorialExport, 'users.xlsx');
    }
}
