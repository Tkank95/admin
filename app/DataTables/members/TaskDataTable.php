<?php

namespace App\DataTables\members;

use App\Helpers\Helper;
use App\Http\Requests\Search\STaskRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TaskDataTable extends DataTable
{
    protected $fastExcel = true;
    protected $fastExcelCallback = false;

    public function dataTable(STaskRequest $taskRequest, $query)
    {
        $dem = $this->getCountTable();
        $count = $dem->count();

        if ($count == 0) {
            $count = "0";
        }

        return datatables()
            ->queryBuilder($query)
            ->filter(function ($query) {
                if (request('filter1') != '') {
                    $query->where('user_id', request('filter1'));
                }
                if (request('filter2') != '') {
                    $query->where('tasks.status', request('filter2'));
                }
                if (request('filter3') != '') {
                    $query->whereBetween('end', [request('filter3') . " 00:00:00", request('filter3') . " 23:59:59"]);
                }
                if (request('datatableSearch') != '') {
                    $query->join('task_tags', 'tag_id', '=', 'task_tags.id')
                        ->where('task_tags.name', 'like', "%" . request('datatableSearch') . "%")
                        ->orwhere('tasks.name', 'like', "%" . request('datatableSearch') . "%")
                        ->orwhere('tasks.location', 'like', "%" . request('datatableSearch') . "%")
                        ->orwhere('tasks.description', 'like', "%" . request('datatableSearch') . "%");
                }
                if (request('start_date') != '' && request('end_date') != '' && request('end_date') >= request('start_date')) {
                    $query->whereBetween('tasks.created_at', [request('start_date') . " 00:00:00", request('end_date') . " 23:59:59"]);
                }
                if (request('filterDateStart') != '') {
                    switch (request('filterDateStart')) {
                        case ('daily'):
                            $query->whereBetween('tasks.start', [now()->startOfDay(), now()->endOfDay()]);
                            break;
                        case ('weekly'):
                            $query->whereBetween('tasks.start', [now()->startOfWeek(), now()->endOfWeek()]);
                            break;
                        case ('monthly'):
                            $query->whereBetween('tasks.start', [now()->firstOfMonth(), now()->endOfMonth()]);
                            break;
                        case ('yearly'):
                            $query->whereBetween('tasks.start', [now()->firstOfYear(), now()->endOfYear()]);
                            break;
                        default:
                            break;
                    }
                }
            })
            ->editColumn('', function ($row) {
                return Helper::checkbox($row->id);
            })
            ->editColumn('status', function ($row) {
                return $row->status == 1 ? '<span class="btn btn-info btn-xs">Open</span>'
                    : ($row->status == 2 ? '<span class="btn btn-primary btn-xs">In progress</span>' :
                        '<span class="btn btn-danger btn-xs">Closed</span>');
            })
            ->editColumn('repeat', function ($row) {
                return $row->repeat == 0 ? '<span class="btn btn-danger btn-xs">Never</span>'
                    : ($row->repeat == 1 ? '<span class="btn btn-warning btn-xs">Everyday</span>'
                        : ($row->repeat == 2 ? '<span class="btn btn-info btn-xs">Weekdays</span>'
                            : '<span class="btn btn-primary btn-xs">Monthly</span>'));
            })
            ->editColumn('attachment', function ($row) {
                $thumbnail = '';
                $file = $row->attachment;
                $replace = str_replace('storage', 'public', $file);

                $list_ext = ['jpeg', 'png', 'jpg', 'gif', 'svg', 'xlsx', 'xls', 'pdf', 'doc', 'docx', 'ppt', 'pptx',
                    'csv', 'rar', 'zip', 'avi', 'mp3', 'wma', 'wav', 'mp4', 'mkv', 'flv', 'mpg', 'mov', 'txt'];

                if ($file !== null && Storage::exists($replace)) {

                    $ext = pathinfo($replace, PATHINFO_EXTENSION);

                    $check_list_ext = in_array($ext, $list_ext, true);
                    $check_list_ext ? $thumb = '../assets/images/files/512x512/' . $ext . '.png' : $thumb = '../assets/images/files/512x512/find.png';

                    $thumbnail = '<a target="blank" href="' . $file . '"><img class="avatar avatar-sm" alt="Tệp đính kèm" src="' . $thumb . '"></a>';
                }
                return $thumbnail;
            })
            ->editColumn('description', '{!! Str::limit($description, 15) !!}')
            ->editColumn('tag_name', '{!! Str::limit($tag_name, 20) !!}')
            ->editColumn('location', '{!! Str::limit($location, 15) !!}')
            ->editColumn('name', '{!! Str::limit($name, 20) !!}')
            ->addColumn('action', function ($row) {
                return '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-sm btn-white action_edit">
                        <i class="tio-edit"></i></a>
                        <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm action_delete"
                        data-url="task/destroy/' . $row->id . '"><i class="tio-delete-outlined"></i></a>';
            })
            ->setFilteredRecords($count)
            ->setTotalRecords($count)
            ->skipTotalRecords()
            ->rawColumns(['', 'action', 'status', 'tag_name', 'name', 'repeat', 'attachment']);
    }

    public function query(): Builder
    {
        return DB::table('tasks')
            ->join('users as u', 'user_id', '=', 'u.id')
            ->join('task_tags as tag', 'tag_id', '=', 'tag.id')
            ->select('u.username', 'tag.name as tag_name', 'tasks.*')
            ->orderBy('id', 'desc');
    }

    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->pageLength(10)
            ->searching(false)
            ->ajax([
                'url' => 'user/task/list',
                'type' => 'GET',
                'data' => 'function(d) {
                     d.filterDateStart = $("#filterDateStart").val();
                     d.filter1 = $("#filter1").val();
                     d.filter2 = $("#filter2").val();
                     d.filter3 = $("#filter3").val();
                     d.start_date = $("#start_date").val();
                     d.end_date = $("#end_date").val();
                     d.datatableSearch = $("#datatableSearch").val();
                }',
                'error' => 'function (data) {
                    let errors = data.responseJSON;
                    let errorsHtml = "";
                    $.each(errors, function (key, value) {
                        errorsHtml += "<li>" + value[0] + "</li>";
                    });
                    toastr.error(errorsHtml, "Tìm kiếm lỗi!");
                    Swal.fire("Error!", errorsHtml, "error");
                    resetInput();
                    $("#datatable_processing").hide();
            }'])
            ->buttons(
                Button::make('copy'),
                Button::make('print'),
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf')
            );
    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')->hidden(),
            Column::checkbox(),
            Column::make('username')->title('Username')->orderable(false)->searchable(false),
            Column::make('tag_name')->title('Thẻ nhiệm vụ')->orderable(false)->searchable(false),
            Column::make('name')->title('Tên nhiệm vụ')->orderable(false)->searchable(false),
            Column::make('start')->title('Ngày giao')->addClass('text-center')->searchable(false),
            Column::make('end')->title('Deadline')->addClass('text-center')->searchable(false),
            Column::make('status')->title('Trạng thái')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('repeat')->addClass('text-center')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('attachment')->title('File')->addClass('text-center')->searchable(false)->orderable(false),
            Column::make('location')->title('Địa điểm')->orderable(false)->searchable(false),
            Column::make('description')->title('Ghi chú')->orderable(false)->searchable(false),
            Column::computed('action')->addClass('text-center')->exportable(false)->printable(false)->searchable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Task_' . date('YmdHis');
    }

    public function getCountTable(): Builder
    {
        $to = request('end_date');
        $from = request('start_date');
        $filter1 = request('filter1');
        $filter2 = request('filter2');
        $filter3 = request('filter3');
        $search = request('datatableSearch');

        $news = DB::table('tasks');

        if (!empty(request()->input())) {
            if ($filter1 != '') {
                $news->where('user_id', $filter1);
            }
            if ($filter2 != '') {
                $news->where('status', $filter2);
            }
            if ($filter3 != '') {
                $news->whereBetween('end', [$filter3 . " 00:00:00", $filter3 . " 23:59:59"]);
            }
            if ($search != '') {
                $news->join('task_tags', 'tag_id', '=', 'task_tags.id')
                    ->where('task_tags.name', 'like', "%" . $search . "%")
                    ->orwhere('tasks.name', 'like', "%" . $search . "%")
                    ->orwhere('tasks.location', 'like', "%" . $search . "%")
                    ->orwhere('tasks.description', 'like', "%" . $search . "%");
            }
            if ($from != '' && $to != '' && $to >= $from) {
                $news->whereBetween('tasks' . '.created_at', [$from . " 00:00:00", $to . " 23:59:59"]);
            }
            if (request('filterDateStart') != '') {
                switch (request('filterDateStart')) {
                    case ('daily'):
                        $news->whereBetween('tasks.start', [now()->startOfDay(), now()->endOfDay()]);
                        break;
                    case ('weekly'):
                        $news->whereBetween('tasks.start', [now()->startOfWeek(), now()->endOfWeek()]);
                        break;
                    case ('monthly'):
                        $news->whereBetween('tasks.start', [now()->firstOfMonth(), now()->endOfMonth()]);
                        break;
                    case ('yearly'):
                        $news->whereBetween('tasks.start', [now()->firstOfYear(), now()->endOfYear()]);
                        break;
                    default:
                        break;
                }
            }
        }

        return $news;
    }
}
