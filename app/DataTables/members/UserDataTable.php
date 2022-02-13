<?php

namespace App\DataTables;

use App\Helpers\Helper;
use App\Http\Requests\Search\SUserRequest;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    protected $fastExcel = true;
    protected $fastExcelCallback = false;

    public function dataTable(SUserRequest $userDataTable, $query)
    {
        $dem = Helper::getCount('users', 'status', 'position', 'email', 'username', 'name');
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
                if (request('filter2') != '') {
                    $query->where('position', request('filter2'));
                }
                if (request('filter3') != '') {
                    $query->where('email', request('filter3'));
                }
                if (request('datatableSearch') != '') {
                    $query->where('username', 'like', "%" . request('datatableSearch') . "%")
                        ->orwhere('name', 'like', "%" . request('datatableSearch') . "%");
                }
                if (request('start_date') != '' && request('end_date') != '' && request('end_date') >= request('start_date')) {
                    $query->whereBetween('users.created_at', [request('start_date') . " 00:00:00", request('end_date') . " 23:59:59"]);
                }
            })
            ->editColumn('', function ($row) {
                return Helper::checkbox($row->id);
            })
            ->editColumn('gender', function ($row) {
                return Helper::gender($row->gender);
            })
            ->editColumn('status', function ($row) {
                return Helper::status($row->status, $row->id);
            })
            ->editColumn('banned_until', function ($row) {
                if ($row->banned_until === null) {
                    return '<span class="btn btn-outline-primary btn-xs banned" data-id="' . $row->id . '" data-toggle="modal" data-target="#bannedUser">No banned</span>';
                }
                return '<span class="btn btn-danger btn-xs banned" data-id="' . $row->id . '" data-toggle="modal" data-target="#bannedUser">' . $row->banned_until . '</span>';
            })
            ->addColumn('action', function ($row) {
                return Helper::action('user', $row->id);
            })
            ->addColumn('fullname', function ($row) {
                return '<a data-fancybox="single" href="' . $row->avatar . '" class="media align-items-center"><div class="avatar avatar-circle mr-3">
                    <img class="avatar-img" src="' . $row->avatar . '" alt="Image Description"></div>
                    <div class="media-body"><span class="d-block h5 text-hover-primary mb-0"> ' . $row->name . ' </span>
                    <span class="d-block font-size-sm text-body">' . $row->username . '</span><span class="d-block font-size-sm text-body">' . $row->email . '</span></div></a>';
            })
            ->setFilteredRecords($count)
            ->setTotalRecords($count)
            ->skipTotalRecords()
            ->rawColumns(['', 'fullname', 'gender', 'status', 'banned_until', 'action']);
    }

    public function query(): Builder
    {
        return DB::table('users')
            ->join('member_info', 'user_id', '=', 'users.id')
            ->select('users.id', 'users.avatar', 'users.name', 'users.email', 'users.username',
                'member_info.gender', 'member_info.birthday', 'member_info.phone',
                DB::raw('(CASE WHEN users.position = "1" THEN "Admin"
                                    WHEN users.position = "2" THEN "Smod"
                                    WHEN users.position = "3" THEN "Mod"
                                    WHEN users.position = "4" THEN "Agency"
                                    ELSE "User" END) AS position'),
                'member_info.team', 'users.status', 'users.banned_until', 'users.created_at');
    }

    public function html()
    {
        return $this->builder()
            ->columns($this->getColumns())
            ->pageLength(5)
            ->searching(false)
            ->ajax([
                'url' => 'user/list',
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
            Column::computed('fullname')->orderable(false),
            Column::make('gender')->title('Giới tính')->addClass('text-center')->searchable(false),
            Column::make('birthday')->title('Ngày sinh')->addClass('text-center')->searchable(false),
            Column::make('phone')->title('Số điện thoại')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('position')->title('Chức vụ')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('team')->title('Boss Team')->addClass('text-center')->orderable(false)->searchable(false),
            Column::make('status')->title('Trạng thái')->addClass('text-center')->searchable(false)->orderable(false),
            Column::make('banned_until')->title('Banned')->addClass('text-center')->searchable(false),
            Column::make('created_at')->addClass('text-center')->searchable(false),
            Column::computed('action')->addClass('text-center')->exportable(false)->printable(false)->searchable(false),
        ];
    }

    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
