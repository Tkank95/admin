<?php

namespace App\DataTables;

use App\Helpers\Helper;
use App\Http\Requests\Search\SPromoteRequest;
use App\Traits\GetCountTable;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class PromoteDataTable extends DataTable
{
    use GetCountTable;

    protected $fastExcel = true;
    protected $fastExcelCallback = false;

    public function dataTable(SPromoteRequest $promoteRequest, $query)
    {
        $dem = $this->getCountTable('promote', 'applications.cate_id', 'app_id', 'status',
            'title', 'content', 'applications', 'app_id', '=', 'applications.id');
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
                    $query->where('app_id', request('filter2'));
                }
                if (request('filter3') != '') {
                    $query->where('promote.status', request('filter3'));
                }
                if (request('datatableSearch') != '') {
                    $query->where('title', 'like', "%" . request('datatableSearch') . "%")
                        ->orwhere('content', 'like', "%" . request('datatableSearch') . "%");
                }
                if (request('start_date') != '' && request('end_date') != '' && request('end_date') >= request('start_date')) {
                    $query->whereBetween('promote.created_at', [request('start_date') . " 00:00:00", request('end_date') . " 23:59:59"]);
                }
            })
            ->editColumn('', function ($row) {
                return Helper::checkbox($row->id);
            })
            ->editColumn('status', function ($row) {
                return Helper::status($row->status, $row->id);
            })
            ->addColumn('action', function ($row) {
                return Helper::action('promote', $row->id);
            })
            ->editColumn('banner', function ($row) {
                return Helper::image($row->banner);
            })
            ->editColumn('title', '{!! Str::limit($title, 20) !!}')
            ->editColumn('content', '{!! Str::limit($content, 20) !!}')
            ->editColumn('register', '{!! Str::limit($register, 20) !!}')
            ->setFilteredRecords($count)
            ->setTotalRecords($count)
            ->skipTotalRecords()
            ->rawColumns(['', 'banner', 'title', 'content', 'register', 'status', 'action']);
    }

    public function query(): Builder
    {
        return DB::table('promote')
            ->join('applications', 'app_id', '=', 'applications.id')
            ->select('applications.name', 'applications.cate_id', 'promote.*')
            ->addSelect(['cate_name' => DB::table('applications as parent')
                ->select('parent.name')
                ->whereColumn('parent.id', 'applications.cate_id')]);
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->pageLength(5)
            ->searching(false)
            ->ajax([
                'url' => 'promote/list',
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
            Column::make('name')->title('Ứng dụng')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('banner')->title('Banner')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('title')->title('Tiêu đề')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('content')->title('Nội dung')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('register')->title('Hướng dẫn đăng ký')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('status')->title('Trạng thái')->addClass('text-center')->searchable(false)->orderable(false),
            Column::make('created_at')->addClass('text-center')->searchable(false),
            Column::make('updated_at')->addClass('text-center')->searchable(false)->orderable(false),
            Column::computed('action')->addClass('text-center')->exportable(false)->printable(false)->searchable(false),
        ];
    }

    protected function filename()
    {
        return 'Promote_' . date('YmdHis');
    }
}
