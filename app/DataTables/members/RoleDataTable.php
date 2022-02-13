<?php

namespace App\DataTables;

use App\Helpers\Helper;
use App\Http\Requests\Search\SRoleRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
{
    protected $fastExcel = true;
    protected $fastExcelCallback = false;

    public function dataTable(SRoleRequest $roleRequest, $query)
    {
        $dem = Helper::getCount('roles', '', '', '', 'name', 'display_name');
        $count = $dem->count();
        if ($count == 0) {
            $count = "0";
        }

        return datatables()
            ->queryBuilder($query)
            ->filter(function ($query) {
                if (request('datatableSearch') != '') {
                    $query->where('name', 'like', "%" . request('datatableSearch') . "%")
                        ->orwhere('display_name', 'like', "%" . request('datatableSearch') . "%");
                }
                if (request('start_date') != '' && request('end_date') != '' && request('end_date') >= request('start_date')) {
                    $query->whereBetween('roles.created_at', [request('start_date') . " 00:00:00", request('end_date') . " 23:59:59"]);
                }
            })
            ->editColumn('', function ($row) {
                return Helper::checkbox($row->id);
            })
            ->editColumn('display_name', '{!! Str::limit($display_name, 100) !!}')
            ->addColumn('action', function ($row) {
                return Helper::action('role', $row->id);
            })
            ->setFilteredRecords($count)
            ->setTotalRecords($count)
            ->skipTotalRecords()
            ->rawColumns(['display_name', 'action', '']);
    }

    public function query(): \Illuminate\Database\Query\Builder
    {
        return DB::table('roles')->select('roles.id', 'roles.name', 'roles.display_name',
            DB::raw('count(role_user.role_id) AS count_user'), 'roles.created_at', 'roles.updated_at')
            ->leftJoin('role_user', 'role_user.role_id', '=', 'roles.id')
            ->groupBy('roles.id');


    }

    public function html(): Builder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->pageLength(5)
            ->searching(false)
            ->ajax([
                'url' => 'role/list',
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
            Column::make('name')->orderable(false)->searchable(false),
            Column::make('count_user')->title('User')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('display_name')->title('Mô tả')->orderable(false)->searchable(false),
            Column::make('created_at')->title('Ngày tạo')->addClass('text-center')->searchable(false),
            Column::make('updated_at')->addClass('text-center')->searchable(false),
            Column::computed('action')->addClass('text-center')->exportable(false)->printable(false)->searchable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Role_' . date('YmdHis');
    }
}
