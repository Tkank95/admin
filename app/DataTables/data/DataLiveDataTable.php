<?php

namespace App\DataTables;

use App\Helpers\Helper;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class DataLiveDataTable extends DataTable
{
    protected $fastExcel = true;
    protected $fastExcelCallback = false;

    public function dataTable($query)
    {
        $dem = $this->getCountTable();

        $count = $dem->count();

        if ($count == 0) {
            $count = "0";
        }

        $datatable = datatables()
            ->queryBuilder($query)
            ->filter(function ($query) {
                if (request('filter1') != '') {
                    $query->where('applications.cate_id', request('filter1'));
                }
                if (request('filter2') != '') {
                    $query->where('app_id', request('filter2'));
                }
                if (request('filter3') != '') {
                    $query->where('user_id', request('filter3'));
                }
                if (request('datatableSearch') != '') {
                    $query->where('id_in_app', 'like', "%" . request('datatableSearch') . "%")
                        ->orwhere('team', 'like', "%" . request('datatableSearch') . "%")
                        ->orwhere('nickname', 'like', "%" . request('datatableSearch') . "%");
                }
                if (request('start_date') != '' && request('end_date') != '' && request('end_date') >= request('start_date')) {
                    $query->whereBetween('data_live.date', [request('start_date') . " 00:00:00", request('end_date') . " 23:59:59"]);
                }
            })
            ->editColumn('', function ($row) {
                return Helper::checkbox($row->id);
            })
            ->editColumn('income', function ($row) {
                return number_format($row->income, 0, ',', '.');
            })
            ->editColumn('new_fan', function ($row) {
                return number_format($row->new_fan, 0, ',', '.');
            })
            ->editColumn('nickname', '{!! Str::limit($nickname, 10) !!}')
            ->setFilteredRecords($count)
            ->setTotalRecords($count)
            ->skipTotalRecords()
            ->setRowAttr([
                'data-id' => function ($row) {
                    return $row->id;
                }
            ])
            ->addColumn('action', function ($row) {
                return '<a href="javascript:;" class="js-edit btn btn-sm btn-white"><i class="js-edit-icon tio-edit"></i></a>
                        <a href="javascript:" class="btn btn-outline-danger btn-sm action_delete" data-url="data/live/destroy/' . $row->id . '">
                        <i class="tio-delete-outlined"></i></a>';
            })
            ->with('total', function () {
                return ['totalDate' => '', 'totalTime' => '', 'totalDay' => '', 'totalIncome' => '', 'totalFan' => '', 'show' => 'none'];
            })
            ->rawColumns(['', 'income', 'new_fan', 'action']);


        // Nếu tìm kiếm thì sẽ đếm tổng ngày live + thời gian live + ngày hiệu lực + quà tăng mới + fan tăng mới
        // Nếu tìm kiếm có kết quả thì sẽ hiểm thị báo cáo, không có kết quả không hiển thị
        if ((request('filter1') != '' || request('filter2') != '' || request('filter3') != '' ||
                request('datatableSearch') != '' || request('start_date') != '' || request('end_date') != '') && $count > 0) {
            $datatable->withQuery('total', function ($row) use ($count) {
                $totalDate = $row->count('date');
                $totalTime = $row->sum('valid_time');
                $totalDay = $row->sum('valid_day');
                $totalIncome = number_format($row->sum('income'), 0, ',', '.'); // Định dạng số hiển thị ví dụ 1.000
                $totalFan = number_format($row->sum('new_fan'), 0, ',', '.');
                $countShow = $count > 0 ? 'block' : 'none';
                return [
                    'totalDate' => $totalDate,
                    'totalTime' => $totalTime,
                    'totalDay' => $totalDay,
                    'totalIncome' => $totalIncome,
                    'totalFan' => $totalFan,
                    'show' => $countShow
                ];
            });
        }

        return $datatable;
    }

    public function query(): Builder
    {
        $query = DB::table('apply_jobs')
            ->join('users', 'user_id', '=', 'users.id')
            ->join('applications', 'app_id', '=', 'applications.id')
            ->join('result_cast', 'result_cast.apply_id', '=', 'apply_jobs.id')
            ->rightJoin('data_live', 'data_live.apply_id', '=', 'apply_jobs.id')
            ->select('data_live.id', 'users.username', 'applications.name as app', 'apply_jobs.id_in_app',
                'apply_jobs.nickname', 'apply_jobs.team', 'result_cast.start_day',
                DB::raw('(CASE WHEN result_cast.result = "0" THEN "Fail"
                                    WHEN result_cast.result = "1" THEN "Pass"
                                    WHEN result_cast.result = "2" THEN "Pending"
                                    ELSE "No cast" END) AS result'),
                DB::raw('(CASE WHEN result_cast.wage = "0" THEN "Pending"
                                    WHEN result_cast.wage = "1" THEN "Chỉ tiêu quà"
                                    WHEN result_cast.wage = "2" THEN "Top BXH"
                                    ELSE result_cast.wage END) AS wage'), 'data_live.date',
                'data_live.valid_time', 'data_live.valid_day', 'data_live.income', 'data_live.new_fan')
            ->addSelect(['cate_name' => DB::table('applications as parent')
                ->select('parent.name')
                ->whereColumn('parent.id', 'applications.cate_id')])
            ->where('result_cast.result', 1);

        // Nếu khoảng ngày tìm kiếm rỗng thì sẽ lấy ngày đầu và cuối tháng hiện tại
        if (request('start_date') == '' && request('end_date') == '') {
            $query->whereBetween('data_live.date', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()]);
        }

        return $query;
    }

    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->pageLength(10)
            ->searching(false)
            ->createdRow("function( row, data, dataIndex ) {
                $(row).find('td:eq(1)').attr('data-field','date');
                $(row).find('td:eq(10)').attr('data-field','valid_time');
                $(row).find('td:eq(11)').attr('data-field','valid_day');
                $(row).find('td:eq(12)').attr('data-field','income');
                $(row).find('td:eq(13)').attr('data-field','new_fan');
            }")
            ->ajax([
                'url' => 'data/live/list',
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
            ->drawCallback("function(data) {
                $('#tableReport').css('display', data.json.total.show);
                $('#sumDay').text(data.json.total.totalDate);
                $('#sumLiveTime').text(data.json.total.totalTime);
                $('#sumLiveDayActive').text(data.json.total.totalDay);
                $('#sumIncome').text(data.json.total.totalIncome);
                $('#sumFan').text(data.json.total.totalFan);
            }")
            ->buttons([
                Button::make('copy'),
                Button::make('print'),
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
            ]);

    }

    protected function getColumns(): array
    {
        return [
            Column::make('id')->hidden(),
            Column::checkbox(),
            Column::make('date')->title('Thời gian')->orderable(false)->searchable(false),
            Column::make('username')->orderable(false)->searchable(false),
            Column::make('cate_name')->title('Thể loại')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('app')->title('Ứng dụng')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('id_in_app')->title('id in app')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('nickname')->title('nickname')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('team')->title('Agency')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('start_day')->title('Ngày bắt đầu')->addClass('text-center')->searchable(false)->orderable(false),
            Column::make('wage')->title('Lương cứng ($)')->addClass('text-center')->searchable(false)->orderable(false),
            Column::make('valid_time')->title('Times (h)')->addClass('text-center')->searchable(false)->orderable(false),
            Column::make('valid_day')->title('Day')->addClass('text-center')->searchable(false)->orderable(false),
            Column::make('income')->title('Income')->addClass('text-center')->searchable(false)->orderable(false),
            Column::make('new_fan')->title('New Fans')->addClass('text-center')->searchable(false)->orderable(false),
            Column::computed('action')->addClass('text-center')->exportable(false)->printable(false)->searchable(false),
        ];
    }

    protected function filename(): string
    {
        return 'DataLive_' . date('YmdHis');
    }

    public function getCountTable(): Builder
    {
        $to = request('end_date');
        $from = request('start_date');
        $filter1 = request('filter1');
        $filter2 = request('filter2');
        $filter3 = request('filter3');
        $search = request('datatableSearch');

        $this->checkRequest() == true ? $news = DB::table('data_live') : $news = DB::table('apply_jobs');

        if (!empty(request()->input())) {
            if ($filter1 != '') {
                $news->join('applications', 'app_id', '=', 'applications.id')
                    ->where('applications.cate_id', $filter1);
            }
            if ($filter2 != '') {
                $news->where('app_id', $filter2);
            }
            if ($filter3 != '') {
                $news->where('user_id', $filter3);
            }
            if ($search != '') {
                $news->where('id_in_app', 'like', "%" . $search . "%")
                    ->orwhere('team', 'like', "%" . $search . "%")
                    ->orwhere('nickname', 'like', "%" . $search . "%");
            }
            if ($from != '' && $to != '' && $to >= $from) {
                $news->join('data_live', 'data_live.apply_id', '=', 'apply_jobs.id')
                    ->whereBetween('data_live.date', [$from . " 00:00:00", $to . " 23:59:59"]);
            }
        }

        return $news;
    }

    protected function checkRequest(): bool
    {
        if (request('filter1') == '' && request('filter2') == '' && request('filter3') == '' &&
            request('datatableSearch') == '' && request('start_date') == '' && request('end_date') == '') {
            return true;
        } else {
            return false;
        }
    }
}
