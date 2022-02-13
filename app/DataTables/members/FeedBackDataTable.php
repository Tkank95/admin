<?php

namespace App\DataTables;

use App\Helpers\Helper;
use App\Http\Requests\Search\SBankRequest;
use App\Http\Requests\Search\SFeedBackRequest;
use App\Traits\GetCountTable;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class FeedBackDataTable extends DataTable
{
    use GetCountTable;

    protected $fastExcel = true;
    protected $fastExcelCallback = false;

    public function dataTable(SFeedBackRequest $request, $query)
    {
        $dem = $this->getCountTable('feedbacks', 'user_id', 'phone', 'email', 'content', 'result');
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
                    $query->where('phone', request('filter2'));
                }
                if (request('filter3') != '') {
                    $query->where('email', request('filter3'));
                }
                if (request('datatableSearch') != '') {
                    $query->where('content', 'like', "%" . request('datatableSearch') . "%")
                        ->orwhere('result', 'like', "%" . request('datatableSearch') . "%");
                }
                if (request('start_date') != '' && request('end_date') != '' && request('end_date') >= request('start_date')) {
                    $query->whereBetween('feedbacks.created_at', [request('start_date') . " 00:00:00", request('end_date') . " 23:59:59"]);
                }
            })
            ->editColumn('', function ($row) {
                return Helper::checkbox($row->id);
            })
            ->editColumn('content', '{!! Str::limit($content, 20) !!}')
            ->editColumn('result', '{!! Str::limit($result, 20) !!}')
            ->addColumn('action', function ($row) {
                return '<a href="javascript:void(0)" data-id="'.$row->id.'" class="btn btn-sm btn-white action_edit">
                        <i class="tio-edit"></i></a>
                        <a href="javascript:void(0)" class="btn btn-outline-danger btn-sm action_delete"
                        data-url="feedback/destroy/'.$row->id.'"><i class="tio-delete-outlined"></i></a>';
            })
            ->setFilteredRecords($count)
            ->setTotalRecords($count)
            ->skipTotalRecords()
            ->rawColumns(['', 'content', 'result', 'action']);
    }

    public function query(): Builder
    {
        return DB::table('feedbacks')
            ->leftJoin('users', 'user_id', '=', 'users.id')
            ->select(DB::raw('(CASE WHEN feedbacks.user_id = "0" THEN "Guest" ELSE users.username END) AS username'), 'feedbacks.*')
            ->orderBy('id', 'desc');
    }

    public function html(): \Yajra\DataTables\Html\Builder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->pageLength(5)
            ->searching(false)
            ->ajax([
                'url' => 'feedback/list',
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
            Column::make('name')->title('Họ và tên')->orderable(false)->searchable(false),
            Column::make('phone')->title('Số điện thoại')->orderable(false)->searchable(false),
            Column::make('email')->title('email')->orderable(false)->searchable(false),
            Column::make('content')->title('Nội dung')->orderable(false)->searchable(false),
            Column::make('result')->title('Trả lời')->orderable(false)->searchable(false),
            Column::make('created_at')->addClass('text-center')->searchable(false),
            Column::make('updated_at')->addClass('text-center')->searchable(false),
            Column::computed('action')->addClass('text-center')->exportable(false)->printable(false)->searchable(false),
        ];
    }

    protected function filename()
    {
        return 'FeedBack_' . date('YmdHis');
    }
}
