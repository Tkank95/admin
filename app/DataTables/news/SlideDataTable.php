<?php

namespace App\DataTables;

use App\Helpers\Helper;
use App\Http\Requests\Search\SSlideRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Html\Builder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SlideDataTable extends DataTable
{
    protected $fastExcel = true;
    protected $fastExcelCallback = false;

    public function dataTable(SSlideRequest $slideRequest, $query)
    {
        $dem = Helper::getCount('slides', 'status', '', '', 'content', 'description');
        $count = $dem->count();
        if ($count == 0) {
            $count = "0";
        }

        return datatables()
            ->queryBuilder($query)
            ->filter(function ($query) {
                if (request('filter1') != '') {
                    $query->where('status', request('filter1'));
                }
                if (request('datatableSearch') != '') {
                    $query->where('content', 'like', "%" . request('datatableSearch') . "%")
                        ->orwhere('description', 'like', "%" . request('datatableSearch') . "%");
                }
                if (request('start_date') != '' && request('end_date') != '' && request('end_date') >= request('start_date')) {
                    $query->whereBetween('slides.created_at', [request('start_date') . " 00:00:00", request('end_date') . " 23:59:59"]);
                }
            })
            ->editColumn('', function ($row) {
                return Helper::checkbox($row->id);
            })
            ->editColumn('name', '{!! Str::limit($name, 20) !!}')
            ->editColumn('content', '{!! Str::limit($content, 20) !!}')
            ->editColumn('description', '{!! Str::limit($description, 20) !!}')
            ->editColumn('image', function ($row) {
                return Helper::image($row->image);
            })
            ->editColumn('status', function ($row) {
                return Helper::status($row->status, $row->id);
            })
            ->editColumn('link', function ($row) {
                return '<a target="blank" href="' . $row->link . '">' . Str::limit($row->link, 20) . '</a>';
            })
            ->addColumn('action', function ($row) {
                return Helper::action('slide', $row->id);
            })
            ->setFilteredRecords($count)
            ->setTotalRecords($count)
            ->skipTotalRecords()
            ->rawColumns(['', 'name', 'content', 'description', 'status', 'link', 'image', 'action']);
    }

    public function query(): \Illuminate\Database\Query\Builder
    {
        return DB::table('slides');
    }

    public function html(): Builder
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->pageLength(5)
            ->searching(false)
            ->ajax([
                'url' => 'slide/list',
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
            Column::make('content')->orderable(false)->searchable(false),
            Column::make('description')->title('Mô tả')->orderable(false),
            Column::make('link')->orderable(false),
            Column::make('image')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('status')->addClass('text-center')->searchable(false),
            Column::make('created_at')->addClass('text-center')->searchable(false),
            Column::make('updated_at')->addClass('text-center')->searchable(false),
            Column::computed('action')->addClass('text-center')->exportable(false)->printable(false)->searchable(false),
        ];
    }

    protected function filename(): string
    {
        return 'Slide_' . date('YmdHis');
    }
}
