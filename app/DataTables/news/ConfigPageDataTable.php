<?php

namespace App\DataTables;

use App\Helpers\Helper;
use App\Http\Requests\Search\SBankRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ConfigPageDataTable extends DataTable
{
    protected $fastExcel = true;
    protected $fastExcelCallback = false;

    public function dataTable($query)
    {
        $dem = Helper::getCount('config_page', '', '', '', 'config_key', 'config_value');
        $count = $dem->count();
        if ($count == 0) {
            $count = "0";
        }

        return datatables()
            ->queryBuilder($query)
            ->filter(function ($query) {
                if (request('datatableSearch') != '') {
                    $query->where('config_key', 'like', "%" . request('datatableSearch') . "%")
                        ->orwhere('config_value', 'like', "%" . request('datatableSearch') . "%");
                }
                if (request('start_date') != '' && request('end_date') != '' && request('end_date') >= request('start_date')) {
                    $query->whereBetween('config_page.created_at', [request('start_date') . " 00:00:00", request('end_date') . " 23:59:59"]);
                }
            })
            ->editColumn('', function ($row) {
                return Helper::checkbox($row->id);
            })
            ->editColumn('config_value', '{!! Str::limit($config_value, 50) !!}')
            ->addColumn('action', function ($row) {
                return '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-sm btn-white action_edit">
                        <i class="tio-edit"></i> Edit</a>
                        <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm action_delete"
                        data-url="config/destroy/'.$row->id.'"><i class="tio-delete-outlined"></i> Delete</a>';
            })
            ->setFilteredRecords($count)
            ->setTotalRecords($count)
            ->skipTotalRecords()
            ->rawColumns(['', 'config_value', 'action']);
    }

    public function query(): Builder
    {
        return DB::table('config_page');
    }

    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->pageLength(10)
            ->searching(false)
            ->ajax([
                'url' => 'config/list',
                'type' => 'GET',
                'data' => 'function(d) {
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
            Column::make('config_key')->orderable(false)->searchable(false),
            Column::make('config_value')->orderable(false)->searchable(false),
            Column::make('created_at')->addClass('text-center')->searchable(false),
            Column::make('updated_at')->addClass('text-center')->searchable(false),
            Column::computed('action')->addClass('text-center')->exportable(false)->printable(false)->searchable(false),
        ];
    }

    protected function filename()
    {
        return 'ConfigPage_' . date('YmdHis');
    }
}
