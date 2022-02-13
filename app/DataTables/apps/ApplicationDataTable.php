<?php

namespace App\DataTables;

use App\Helpers\Helper;
use App\Http\Requests\Search\SApplicationRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ApplicationDataTable extends DataTable
{
    protected $fastExcel = true;
    protected $fastExcelCallback = false;

    public function dataTable(SApplicationRequest $applicationRequest, $query)
    {
        $dem = self::getCount('applications', 'name', 'cate_id', 'status', 'name', 'link_download');
        $count = $dem->count();
        if ($count == 0) {
            $count = "0";
        }

        return datatables()
            ->queryBuilder($query)
            ->filter(function ($query) {
                if (request('filter1') != '') {
                    $query->where('name', request('filter1'));
                }
                if (request('filter2') != '') {
                    $query->where('cate_id', request('filter2'));
                }
                if (request('filter3') != '') {
                    $query->where('status', request('filter3'));
                }
                if (request('datatableSearch') != '') {
                    $query->where('name', 'like', "%" . request('datatableSearch') . "%")
                        ->orwhere('link_download', 'like', "%" . request('datatableSearch') . "%");
                }
                if (request('start_date') != '' && request('end_date') != '' && request('end_date') >= request('start_date')) {
                    $query->whereBetween('applications.created_at', [request('start_date') . " 00:00:00", request('end_date') . " 23:59:59"]);
                }
            })
            ->editColumn('', function ($row) {
                return Helper::checkbox($row->id);
            })
            ->editColumn('status', function ($row) {
                return Helper::status($row->status, $row->id);
            })
            ->editColumn('logo', function ($row) {
                return Helper::image($row->logo);
            })
            ->editColumn('link_download', function ($row) {
                return '<a target="blank" href="' . $row->link_download . '">Click để mở link tải</a>';
            })
            ->addColumn('action', function ($row) {
                return Helper::action('app', $row->id);
            })
            ->setFilteredRecords($count)
            ->setTotalRecords($count)
            ->skipTotalRecords()
            ->rawColumns(['', 'status', 'logo', 'link_download', 'action']);
    }

    public function query(): \Illuminate\Database\Query\Builder
    {
        return DB::table('applications')->where('cate_id', '<>', 0)
            ->addSelect(['cate_name' => DB::table('applications as parent')
                ->select('parent.name')
                ->whereColumn('parent.id', 'applications.cate_id')]);
    }

    public function html(): Builder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->pageLength(5)
            ->searching(false)
            ->ajax([
                'url' => 'app/list',
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
            Column::make('cate_name')->title('Category')->searchable(false)->orderable(false),
            Column::computed('name')->title('Name')->orderable(false),
            Column::make('logo')->title('Logo')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('top')->title('top')->searchable(false),
            Column::make('link_download')->title('Link download')->orderable(false)->searchable(false),
            Column::make('status')->title('Status')->addClass('text-center')->searchable(false)->orderable(false),
            Column::make('created_at')->addClass('text-center')->searchable(false),
            Column::make('updated_at')->addClass('text-center')->searchable(false)->orderable(false),
            Column::computed('action')->addClass('text-center')->exportable(false)->printable(false)->searchable(false),
        ];
    }

    public static function getCount($table, $col1, $col2, $col3, $search1, $search2): \Illuminate\Database\Query\Builder
    {
        $to = request('end_date');
        $from = request('start_date');
        $filter1 = request('filter1');
        $filter2 = request('filter2');
        $filter3 = request('filter3');
        $search = request('datatableSearch');

        $news = DB::table($table)->where('cate_id', '<>', 0);

        if (!empty(request()->input())) {
            if ($filter1 != '') {
                $news->where($col1, $filter1);
            }
            if ($filter2 != '') {
                $news->where($col2, $filter2);
            }
            if ($filter3 != '') {
                $news->where($col3, $filter3);
            }
            if ($search != '') {
                $news->where($search1, 'like', "%" . $search . "%")
                    ->orwhere($search2, 'like', "%" . $search . "%");
            }
            if ($from != '' && $to != '' && $to >= $from) {
                $news->whereBetween($table . '.created_at', [$from . " 00:00:00", $to . " 23:59:59"]);
            }
        }

        return $news;
    }

    protected function filename(): string
    {
        return 'Application_' . date('YmdHis');
    }
}
