<?php

namespace App\DataTables;

use App\Helpers\Helper;
use App\Http\Requests\Search\SNewTutorialRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class TutorialsDataTable extends DataTable
{
    protected $fastExcel = true;
    protected $fastExcelCallback = false;

    public function dataTable(SNewTutorialRequest $tutorialRequest, $query)
    {
        $dem = Helper::getCount('new_tutorials', 'top', 'app_id', 'user_id', 'title', 'content');
        $count = $dem->count();
        if ($count == 0) {
            $count = "0";
        }

        return datatables()
            ->queryBuilder($query)
            ->filter(function ($query) {
                if (request('filter1') != '') {
                    $query->where('top', request('filter1'));
                }
                if (request('filter2') != '') {
                    $query->where('app_id', request('filter2'));
                }
                if (request('filter3') != '') {
                    $query->where('user_id', request('filter3'));
                }
                if (request('datatableSearch') != '') {
                    $query->where('title', 'like', "%" . request('datatableSearch') . "%")
                        ->orwhere('content', 'like', "%" . request('datatableSearch') . "%");
                }
                if (request('start_date') != '' && request('end_date') != '' && request('end_date') >= request('start_date')) {
                    $query->whereBetween('new_tutorials.created_at', [request('start_date') . " 00:00:00", request('end_date') . " 23:59:59"]);
                }
            })
            ->editColumn('', function ($row) {
                return Helper::checkbox($row->id);
            })
            ->editColumn('content', '{!! Str::limit($content, 30) !!}')
            ->editColumn('image', function ($row) {
                return Helper::image($row->image);
            })
            ->addColumn('action', function ($row) {
                return Helper::action('news', $row->id);
            })
            ->setFilteredRecords($count)
            ->setTotalRecords($count)
            ->skipTotalRecords()
            ->rawColumns(['content', 'image', 'action', '']);
    }

    public function query(): \Illuminate\Database\Query\Builder
    {
        return DB::table('new_tutorials')
            ->join('users', 'user_id', '=', 'users.id')
            ->join('applications', 'app_id', '=', 'applications.id')
            ->select('new_tutorials.id','users.username as user','applications.name as app','new_tutorials.title','new_tutorials.content','new_tutorials.image',
                'new_tutorials.top','new_tutorials.created_at','new_tutorials.updated_at');
    }

    public function html(): Builder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->pageLength(5)
            ->searching(false)
            ->ajax([
                'url' => 'news/list',
                'type' => 'GET',
                'data' => 'function(d) {
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
            Column::make('user')->title('Tác giả')->orderable(false)->searchable(false),
            Column::make('app')->title('Thể loại')->orderable(false)->searchable(false),
            Column::make('title')->title('Tiêu đề')->orderable(false),
            Column::make('content')->title('Nội dung')->orderable(false),
            Column::make('image')->title('Ảnh bìa')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('top')->addClass('text-center')->searchable(false),
            Column::make('created_at')->title('Ngày tạo')->addClass('text-center')->searchable(false),
            Column::make('updated_at')->title('Update')->addClass('text-center')->searchable(false),
            Column::computed('action')->addClass('text-center')->exportable(false)->printable(false)->searchable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Tutorials_' . date('YmdHis');
    }
}
