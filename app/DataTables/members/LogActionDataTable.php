<?php

namespace App\DataTables;

use App\Helpers\Helper;
use App\Http\Requests\Search\SLogActionRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class LogActionDataTable extends DataTable
{
    protected $fastExcel = true;
    protected $fastExcelCallback = false;

    public function dataTable(SLogActionRequest $logActionRequest, $query)
    {
        $dem = Helper::getCount('activity_log', 'log_name', 'causer_id', 'description', 'ip', 'subject_type');
        $count = $dem->count();
        if ($count == 0) {
            $count = "0";
        }

        return datatables()
            ->queryBuilder($query)
            ->filter(function ($query) {
                if (request('filter1') != '') {
                    $query->where('log_name', request('filter1'));
                }
                if (request('filter2') != '') {
                    $query->where('causer_id', request('filter2'));
                }
                if (request('filter3') != '') {
                    $query->where('description', request('filter3'));
                }
                if (request('datatableSearch') != '') {
                    $query->where('ip', 'like', "%" . request('datatableSearch') . "%")
                        ->orwhere('subject_type', 'like', "%" . request('datatableSearch') . "%");
                }
                if (request('start_date') != '' && request('end_date') != '' && request('end_date') >= request('start_date')) {
                    $query->whereBetween('activity_log.created_at', [request('start_date') . " 00:00:00", request('end_date') . " 23:59:59"]);
                }
            })
            ->editColumn('', function ($row) {
                return Helper::checkbox($row->id);
            })
            ->editColumn('subject_type', function ($row) {
                return '<a target="blank" href="' . $row->subject_type . '">' . Str::limit($row->subject_type, 35) . '</a>';
            })
            ->editColumn('agent', function ($row) {
                $agent = json_decode($row->agent, true);
                return $agent['type'] . ': ' . $agent['platform'] . ', <br>' . $agent['device'] . ': ' . $agent['browser'] . ', ' . $agent['browser_version'];
            })
            ->setRowAttr([
                'data-id' => function ($row) {
                    return $row->id;
                }
            ])
            ->setRowClass('detail')
            ->setFilteredRecords($count)
            ->setTotalRecords($count)
            ->skipTotalRecords()
            ->rawColumns(['agent', 'subject_type', '']);
    }

    public function query()
    {
        return DB::table('activity_log')
            ->join('users', 'causer_id', '=', 'users.id')
            ->select('activity_log.id', 'activity_log.log_name', 'activity_log.description',
                'activity_log.subject_type', 'activity_log.subject_id', 'activity_log.causer_id', 'activity_log.ip',
                'activity_log.agent', 'users.username as user', DB::raw('(CASE
                                    WHEN users.position = "1" THEN "Admin"
                                    WHEN users.position = "2" THEN "Smod"
                                    WHEN users.position = "3" THEN "Mod"
                                    WHEN users.position = "4" THEN "Agency"
                                    ELSE "User" END) AS position'),
                'activity_log.properties', 'activity_log.created_at');
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->pageLength(10)
            ->searching(false)
            ->ajax([
                'url' => 'log/log-action',
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
            Column::make('log_name')->title('Log name')->orderable(false)->searchable(false),
            Column::make('description')->title('Mô tả')->orderable(false)->searchable(false),
            Column::make('subject_type')->title('Url')->orderable(false)->searchable(false),
            Column::make('subject_id')->title('Sub id')->orderable(false)->addClass('text-center')->searchable(false),
            Column::make('user')->title('Username')->addClass('text-center')->orderable(false)->searchable(false),
            Column::computed('position')->title('Chức vụ')->orderable(true)->searchable(false),
            Column::make('ip')->title('ip address')->addClass('text-center')->searchable(false)->orderable(false),
            Column::make('agent')->title('device')->orderable(false)->searchable(false),
            Column::make('created_at')->addClass('text-center')->searchable(false)->orderable(false),
        ];
    }

    protected function filename()
    {
        return 'LogAction_' . date('YmdHis');
    }
}
