<?php

namespace App\DataTables;

use App\Helpers\Helper;
use App\Http\Requests\Search\SPolicyRequest;
use App\Traits\GetCountTable;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PolicyDataTable extends DataTable
{
    use GetCountTable;

    protected $fastExcel = true;
    protected $fastExcelCallback = false;

    public function dataTable(SPolicyRequest $policyRequest, $query)
    {
        $dem = $this->getCountTable('policy', 'applications.cate_id', 'app_id', 'status',
            'policy_idol', 'policy_agency', 'applications', 'app_id', '=', 'applications.id');
        $count = $dem->count();

        if ($count == 0) {
            $count = "0";
        }

        return datatables()
            ->queryBuilder($query)
            ->filter(function ($query) {
                if (request('filter1') != '') {
                    $query->where('applications.cate_id', request('filter1'));
                }
                if (request('filter2') != '') {
                    $query->where('policy.app_id', request('filter2'));
                }
                if (request('filter3') != '') {
                    $query->where('policy.status', request('filter3'));
                }
                if (request('datatableSearch') != '') {
                    $query->where('policy_idol', 'like', "%" . request('datatableSearch') . "%")
                        ->orwhere('policy_agency', 'like', "%" . request('datatableSearch') . "%");
                }
                if (request('start_date') != '' && request('end_date') != '' && request('end_date') >= request('start_date')) {
                    $query->whereBetween('policy.created_at', [request('start_date') . " 00:00:00", request('end_date') . " 23:59:59"]);
                }
            })
            ->editColumn('', function ($row) {
                return Helper::checkbox($row->id);
            })
            ->editColumn('status', function ($row) {
                return Helper::status($row->status, $row->id);
            })
            ->addColumn('action', function ($row) {
                return Helper::action('policy', $row->id);
            })
            ->editColumn('policy_idol', function ($row) {
                return '<a target="blank" href="policy/idol-'.$row->id.'-'.$row->cate_id.'-'.$row->app_id.'-'.Str::slug($row->cate_name).'-'.Str::slug($row->name).'">Click để xem chi tiết</a>';
            })
            ->editColumn('policy_agency', function ($row) {
                return '<a target="blank" href="policy/agency-'.$row->id.'-'.$row->cate_id.'-'.$row->app_id.'-'.Str::slug($row->cate_name).'-'.Str::slug($row->name).'">Click để xem chi tiết</a>';
            })
            ->setFilteredRecords($count)
            ->setTotalRecords($count)
            ->skipTotalRecords()
            ->rawColumns(['', 'policy_idol', 'policy_agency', 'status', 'action']);
    }

    public function query(): Builder
    {
        return DB::table('policy')
            ->join('applications', 'app_id', '=', 'applications.id')
            ->select('applications.name','applications.cate_id', 'policy.*')
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
                'url' => 'policy/list',
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
            Column::make('cate_name')->title('Thể loại')->orderable(false)->searchable(false),
            Column::make('name')->title('Application')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('policy_idol')->title('Policy Idol')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('policy_agency')->title('Policy Agency')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('active_day')->title('Policy start date')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('status')->title('Trạng thái')->addClass('text-center')->searchable(false)->orderable(false),
            Column::make('created_at')->addClass('text-center')->searchable(false),
            Column::make('updated_at')->addClass('text-center')->searchable(false)->orderable(false),
            Column::computed('action')->addClass('text-center')->exportable(false)->printable(false)->searchable(false),
        ];
    }

    protected function filename()
    {
        return 'Policy_' . date('YmdHis');
    }
}
