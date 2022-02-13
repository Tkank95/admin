<?php

namespace App\DataTables;

use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ApplyJobDataTable extends DataTable
{
    protected $fastExcel = true;
    protected $fastExcelCallback = false;

    public function dataTable($query)
    {
        $dem = Helper::getCount('apply_jobs', 'user_id', 'app_id', 'cast_datetime', 'id_in_app', 'team');
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
                    $query->where('app_id', request('filter2'));
                }
                if (request('filter3') != '') {
                    $query->where('cast_datetime', request('filter3'));
                }
                if (request('datatableSearch') != '') {
                    $query->where('id_in_app', 'like', "%" . request('datatableSearch') . "%")
                        ->orwhere('team', 'like', "%" . request('datatableSearch') . "%");
                }
                if (request('start_date') != '' && request('end_date') != '' && request('end_date') >= request('start_date')) {
                    $query->whereBetween('apply_jobs.created_at', [request('start_date') . " 00:00:00", request('end_date') . " 23:59:59"]);
                }
            })
            ->editColumn('', function ($row) {
                return Helper::checkbox($row->id);
            })
            ->addColumn('action', function ($row) {
                return Helper::action('job', $row->id);
            })
            ->setFilteredRecords($count)
            ->setTotalRecords($count)
            ->skipTotalRecords()
            ->rawColumns(['', 'action']);
    }

    public function query()
    {
        return DB::table('apply_jobs')
            ->join('users', 'user_id', '=', 'users.id')
            ->join('applications', 'app_id', '=', 'applications.id')
            ->join('result_cast', 'apply_id', '=', 'apply_jobs.id')
            ->select('apply_jobs.id', 'users.username', 'applications.name as app', 'apply_jobs.id_in_app',
                'apply_jobs.team', 'apply_jobs.cast_datetime',
                DB::raw('(CASE WHEN result_cast.result = "0" THEN "Fail"
                                    WHEN result_cast.result = "1" THEN "Pass"
                                    WHEN result_cast.result = "2" THEN "Pending"
                                    ELSE "No cast" END) AS result'),
                DB::raw('(CASE WHEN result_cast.wage = "0" THEN "Pending"
                                    WHEN result_cast.wage = "1" THEN "Chỉ tiêu quà"
                                    WHEN result_cast.wage = "2" THEN "Top BXH"
                                    ELSE result_cast.wage END) AS wage'),
                'apply_jobs.created_at', 'apply_jobs.updated_at')
            ->addSelect(['cate_name' => DB::table('applications as parent')
                ->select('parent.name')
                ->whereColumn('parent.id', 'applications.cate_id')]);
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->pageLength(10)
            ->searching(false)
            ->ajax([
                'url' => 'job/list',
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
            Column::make('username')->orderable(false)->searchable(false),
            Column::make('cate_name')->title('Category')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('app')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('id_in_app')->title('id in app')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('team')->title('Team')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('cast_datetime')->title('Ngày cast')->addClass('text-center')->searchable(false)->orderable(false),
            Column::make('result')->title('Kết quả')->addClass('text-center')->searchable(false),
            Column::make('wage')->title('Lương cứng ($)')->addClass('text-center')->searchable(false)->orderable(false),
            Column::make('created_at')->addClass('text-center')->searchable(false),
            Column::make('updated_at')->addClass('text-center')->searchable(false)->orderable(false),
            Column::computed('action')->addClass('text-center')->exportable(false)->printable(false)->searchable(false),
        ];
    }

    protected function filename()
    {
        return 'ApplyJob_' . date('YmdHis');
    }
}
