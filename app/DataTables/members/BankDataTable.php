<?php

namespace App\DataTables;

use App\Helpers\Helper;
use App\Http\Requests\Search\SBankRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BankDataTable extends DataTable
{
    protected $fastExcel = true;
    protected $fastExcelCallback = false;

    public function dataTable(SBankRequest $request, $query)
    {
        $dem = Helper::getCount('banks', 'bank_name', 'branch', 'user_id', 'banks.name', 'account');
        $count = $dem->count();
        if ($count == 0) {
            $count = "0";
        }

        return datatables()
            ->queryBuilder($query)
            ->filter(function ($query) {
                if (request('filter1') != '') {
                    $query->where('bank_name', request('filter1'));
                }
                if (request('filter2') != '') {
                    $query->where('branch', request('filter2'));
                }
                if (request('filter3') != '') {
                    $query->where('user_id', request('filter3'));
                }
                if (request('datatableSearch') != '') {
                    $query->where('banks.name', 'like', "%" . request('datatableSearch') . "%")
                        ->orwhere('account', 'like', "%" . request('datatableSearch') . "%");
                }
                if (request('start_date') != '' && request('end_date') != '' && request('end_date') >= request('start_date')) {
                    $query->whereBetween('banks.created_at', [request('start_date') . " 00:00:00", request('end_date') . " 23:59:59"]);
                }
            })
            ->editColumn('', function ($row) {
                return Helper::checkbox($row->id);
            })
            ->addColumn('action', function ($row) {
                return Helper::action('bank', $row->id);
            })
            ->setFilteredRecords($count)
            ->setTotalRecords($count)
            ->skipTotalRecords()
            ->rawColumns(['', 'action']);
    }

    public function query(): Builder
    {
        return DB::table('banks')
            ->join('users', 'user_id', '=', 'users.id')
            ->select('banks.id', 'users.username', 'users.email', 'banks.name', 'banks.account',
                'banks.bank_name', 'banks.branch', 'banks.created_at', 'banks.updated_at');
    }

    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->pageLength(5)
            ->searching(false)
            ->ajax([
                'url' => 'bank/list',
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
            Column::make('email')->orderable(false)->searchable(false),
            Column::make('name')->title('Account name')->orderable(false)->searchable(false),
            Column::make('account')->title('Account number')->orderable(false)->searchable(false),
            Column::make('bank_name')->title('Bank name')->searchable(false),
            Column::make('branch')->title('Chi nhánh')->addClass('text-center')->searchable(false),
            Column::make('created_at')->addClass('text-center')->searchable(false),
            Column::make('updated_at')->addClass('text-center')->searchable(false),
            Column::computed('action')->addClass('text-center')->exportable(false)->printable(false)->searchable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Bank_' . date('YmdHis');
    }
}
