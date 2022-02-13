<?php

namespace App\Http\Controllers\members;

use App\DataTables\members\TaskDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\members\Task\TaskFormRequest;
use App\Http\Requests\members\Task\UploadFileRequest;
use App\Models\members\Task;
use App\Traits\DeleteMultipleTrait;
use App\Traits\DeleteTrait;
use App\Traits\LogShowTrait;
use App\Traits\LogViewTrait;
use App\Traits\StatusActiveTrait;
use App\Traits\StatusBlockTrait;
use App\Traits\StorageImageTrait;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    use DeleteTrait, DeleteMultipleTrait, StatusActiveTrait, StatusBlockTrait, LogShowTrait, LogViewTrait, StorageImageTrait;

    private Task $task;
    private $name = 'task';

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function index(TaskDataTable $dataTable)
    {
        $category = DB::table('task_tags')->select('id', 'name')->get();
        return $dataTable->render('admin.members.task.list', [
            'title' => 'Danh sách công việc, nhiệm vụ',
            'category' => $category
        ]);
    }

    public function store(TaskFormRequest $request): JsonResponse
    {
        try {
            $input = $request->input();
            $input['user_created'] = Auth::id();
            Task::create($input);
            return response()->json(['code' => 200, 'message' => 'success']);

        } catch (Exception $err) {
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return response()->json(['code' => 500, 'message' => 'fail'], 500);
        }
    }

    public function show(Task $id): JsonResponse
    {
        $ext = '';
        $thumb = '';
        $filename = '';
        $filesize = '';
        $file = $id->attachment;
        $replace = str_replace('storage', 'public', $file);

        $list_ext = ['jpeg', 'png', 'jpg', 'gif', 'svg', 'xlsx', 'xls', 'pdf', 'doc', 'docx', 'ppt', 'pptx',
            'csv', 'rar', 'zip', 'avi', 'mp3', 'wma', 'wav', 'mp4', 'mkv', 'flv', 'mpg', 'mov', 'txt'];

        if ($file !== null && Storage::exists($replace)) {

            $filename = Str::after($file, '_');
            $ext = pathinfo($replace, PATHINFO_EXTENSION);

            $check_file_size = (Storage::size($replace)) / 1000;
            $check_file_size > 1000 ? $filesize = '<strong>' . number_format($check_file_size / 1000, 1) . '</strong> MB</div>' : $filesize = '<strong>' . number_format($check_file_size, 1) . '</strong> KB</div>';

            $check_list_ext = in_array($ext, $list_ext, true);
            $check_list_ext ? $thumb = '../assets/images/files/512x512/' . $ext . '.png' : $thumb = '../assets/images/files/512x512/find.png';
        }

        return response()->json([
            'task' => $id,
            'filename' => $filename,
            'filesize' => $filesize,
            'ext' => $ext,
            'thumb' => $thumb,
            'user' => $id->createByUser()->get()
        ]);
    }

    public function update(Task $id, TaskFormRequest $request): JsonResponse
    {
        try {
            $id->fill($request->input());
            $id->save();
            return response()->json(['code' => 200, 'message' => 'success']);

        } catch (Exception $err) {
            Log::error($err->getMessage() . ' Line: ' . $err->getLine());
            return response()->json(['code' => 500, 'message' => 'fail'], 500);
        }
    }

    public function destroy(Task $id): JsonResponse
    {
        return $this->deleteTrait($id);
    }

    // Xoá nhiều bản ghi cùng lúc
    public function deleteMultiple(): JsonResponse
    {
        return $this->deleteMultipleTrait($this->income, $this->name);
    }

    public function calendar(Request $request)
    {
        //$user = DB::table('users')->select('id','username', 'avatar')->get();
        $category = DB::table('task_tags')->select('id', 'name')->get();

//        if(request()->ajax())
//        {
        $start = (!empty($request->start)) ? date('Y-m-d H:i:s', strtotime($request->start)) : ('');
        $end = (!empty($request->end)) ? date('Y-m-d H:i:s', strtotime($request->end)) : ('');


        $data = DB::table('tasks')
//            ->join('users', 'user_created', '=', 'users.id')
//            ->join('task_tags', 'tag_id', '=', 'task_tags.id')
//            ->select('users.name as username', 'users.avatar', 'task_tags.name as tagname', 'tasks.*')
                ->whereDate('start', '>=', $start)
                ->whereDate('end', '<=', $end)
            ->get();


//            return response()->json($data);
//        }


        return view('admin.task.calendar', [
            'title' => 'Lịch làm việc',
           'data' => $data,
            //'users' => $user,
            'category' => $category
        ]);
    }

    public function attachment(UploadFileRequest $request): JsonResponse
    {
        $upload_success = $this->storageTraitUpload($request, 'attachFiles', 'task');

        if ($upload_success) {
            return response()->json([
                'code' => 200,
                'message' => 'success',
                'source' => $upload_success['file_path'],
                'thumbnail' => $request->thumbnail
            ]);
        } else {
            return response()->json(['code' => 400, 'message' => 'Tải lên không thành công'], 400);
        }
    }

    public function detachment(Request $request): JsonResponse
    {
        $updated = '';
        if ($request->attachment != '') {
            try {
                DB::table('tasks')->where('id', $request->attachment)->update(['attachment' => null]);
                $updated = 'Thành công';
            } catch (Exception $err) {
                Log::error($err->getMessage() . ' Line: ' . $err->getLine());
                $updated = 'Lỗi';
            }
        }
        $detachment = Storage::delete(str_replace('storage', 'public', $request->id));

        if ($detachment) {
            return response()->json(['code' => 200, 'message' => 'success', 'updated' => $updated]);
        } else {
            return response()->json(['code' => 400, 'message' => 'fail', 'updated' => $updated], 400);
        }
    }
}
