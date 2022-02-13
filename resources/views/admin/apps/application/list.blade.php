@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.list.headerPage', [
                         'breadcrumb_list' => 'app/list',
                         'breadcrumb' => 'Apps',
                         'page' => 'List',
                         'pagetitle' => 'Danh sách ứng dụng live streams',
                         'linkadd' => 'app/add',
                         'add' => 'Add New Application'
                     ])
            {{-- End Page Header --}}

            @include('admin.layout.alert')

            <form>
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3 mb-lg-5">
                            {{-- Header --}}
                            <div class="card-header" id="search-filter">
                                <div class="row justify-content-between align-items-center flex-grow-1">

                                    @include('admin.layout.list.headerForm', [
                                                'headertitle' => 'List Application',
                                                'searchholder' => 'name, link tải ứng dụng'
                                    ])

                                    {{-- Unfold Filters --}}
                                    <div class="hs-unfold mr-2">
                                        <a class="js-hs-unfold-invoker btn btn-white" href="javascript:"
                                           data-hs-unfold-options='{
                                                     "target": "#applicationFilterDropdown",
                                                     "type": "css-animation",
                                                     "smartPositionOff": true
                                                   }'>
                                            <i class="tio-filter-list mr-1"></i> Filter
                                        </a>

                                        <div id="applicationFilterDropdown"
                                             class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right dropdown-card card-dropdown-filter-centered"
                                             style="min-width: 25rem;">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-header-title">Filter application</h5>

                                                    {{-- Toggle Button --}}
                                                    <a class="js-hs-unfold-invoker btn btn-icon btn-xs btn-ghost-secondary ml-2"
                                                       href="javascript:;" data-hs-unfold-options='{
                                                                  "target": "#applicationFilterDropdown",
                                                                  "type": "css-animation",
                                                                  "smartPositionOff": true
                                                                 }'>
                                                        <i class="tio-clear tio-lg"></i>
                                                    </a>
                                                    {{-- End Toggle Button --}}
                                                </div>

                                                <div class="card-body">
                                                    <form id="filter">
                                                        <div class="form-row">
                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">App name</small>
                                                                <input type="text" class="form-control" name="filter1"
                                                                       id="filter1" value="{{ old('filter3') }}"
                                                                       placeholder="Nhập tên app">
                                                            </div>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Category</small>
                                                                <select style="opacity: 0;"
                                                                    class="js-select2-custom js-datatable-filter custom-select"
                                                                    size="1" name="filter2" id="filter2"
                                                                    data-hs-select2-options='{"minimumResultsForSearch": "Infinity"}'>
                                                                    <option value="">All Category</option>
                                                                    @foreach($menus as $cate)
                                                                        <option
                                                                            value="{{ $cate->id }}">{{ $cate->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Status</small>
                                                                <select style="opacity: 0;"
                                                                    class="js-select2-custom js-datatable-filter custom-select"
                                                                    size="1" id="filter3" name="filter3"
                                                                    data-hs-select2-options='{"minimumResultsForSearch": "Infinity"}'>
                                                                    <option value="">All status</option>
                                                                    <option value="1"
                                                                            data-option-template='<span class="legend-indicator bg-primary"></span>Active'>
                                                                        Active
                                                                    </option>
                                                                    <option value="0"
                                                                            data-option-template='<span class="legend-indicator bg-danger"></span>NO'>
                                                                        NO
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Start Date</small>
                                                                <input type="date" class="form-control" id="start_date"
                                                                       name="start_date">
                                                            </div>

                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">End Date</small>
                                                                <input type="date" class="form-control" id="end_date"
                                                                       name="end_date">
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-sm form-group">
                                                                <a class="btn btn-block btn-soft-success" id="reset">
                                                                    <i class="tio-refresh"></i> Reset
                                                                </a>
                                                            </div>
                                                            <div class="col-sm form-group">
                                                                <a class="js-hs-unfold-invoker btn btn-block btn-primary apply"
                                                                   href="javascript:" data-hs-unfold-options='{
                                                                    "target": "#slideFilterDropdown",
                                                                    "type": "css-animation","smartPositionOff": true}'>
                                                                    Apply</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Unfold Filters --}}

                                    {{-- Unfold Columns --}}
                                    <div class="hs-unfold mr-2">
                                        <a class="js-hs-unfold-invoker btn btn-white" href="javascript:"
                                           data-hs-unfold-options='{"target": "#showHideDropdown", "type": "css-animation"}'>
                                            <i class="tio-table mr-1"></i> Columns
                                        </a>

                                        <div id="showHideDropdown"
                                             class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right dropdown-card"
                                             style="width: 15rem;">
                                            <div class="card card-sm">
                                                <div class="card-body">
                                                    @include('admin.layout.list.column.column', [
                                                                'col2' => 'Category',
                                                                'col3' => 'Name',
                                                                'col4' => 'Logo',
                                                                'col5' => 'Top',
                                                                'col6' => 'Link Download',
                                                                'col7' => 'Status',
                                                                'col8' => 'Create_at',
                                                                'col9' => 'Update_at',
                                                                'col10' => 'Action'
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Unfold Columns --}}

                                    {{-- List category --}}
                                    <div class="mr-2 mt-2 mt-sm-0">
                                        <a class="btn btn-outline-primary" data-target="#showCategory"
                                           data-toggle="modal"><i class="tio-drag mr-1"></i> List category
                                        </a>
                                    </div>
                                    {{-- End List category --}}
                                </div>
                            </div>
                            {{-- End Header --}}

                            {{-- Table --}}
                            <div class="table-responsive datatable-custom">
                                {{$dataTable->table()}}
                            </div>
                            {{-- End Table --}}

                            {{-- Footer --}}
                            @include('admin.layout.list.tableFooter')
                            {{-- End Footer --}}
                        </div>
                    </div>
                </div>

                {{-- Show Modal List category --}}
                <div class="modal fade" id="showCategory" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                        <div class="modal-content">

                            {{-- Header --}}
                            <div class="modal-header">
                                <h4 id="showCategoryTitle" class="modal-title">List Category</h4>
                                <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary"
                                        data-dismiss="modal"><i class="tio-clear tio-lg"></i>
                                </button>
                            </div>
                            {{-- End Header --}}

                            <div class="modal-body">
                                <form>
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="card mb-3 mb-lg-5">
                                                <div class="card-header">
                                                    <h4 class="card-header-title">Danh sách thể loại application</h4>
                                                </div>

                                                {{-- Table --}}
                                                <div class="table-responsive datatable-custom">
                                                    <table
                                                        class="table table-border table-hover table-thead-bordered table-nowrap table-align-middle card-table">
                                                        <thead class="thead-light ">
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Status</th>
                                                            <th>Updated_at</th>
                                                            <th>Action</th>
                                                        </tr>
                                                        </thead>

                                                        <tbody>
                                                        @foreach($categories as $category)
                                                            <tr>
                                                                <td>{{$category->id}}</td>
                                                                <td>{{$category->name}}</td>
                                                                <td>{!! $category->status == 0 ? '<span class="btn btn-danger btn-xs active_status_cate" data-id="' . $category->id . '">NO</span>'
                                                                        : '<span class="btn btn-primary btn-xs deactive_status_cate" data-id="' . $category->id . '">Active</span>'!!}
                                                                </td>
                                                                <td>{{$category->updated_at}}</td>
                                                                <td>{!! \App\Helpers\Helper::action('app', $category->id) !!}</td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                                {{-- End Table --}}

                                                <div class="card-body">
                                                    <div
                                                        class="card-footer d-flex justify-content-end align-items-center">
                                                        <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal"> Đóng
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Show Modal List category --}}
            </form>
        </div>
    </main>>
@endsection

@push('scripts')
    <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
    {{$dataTable->scripts()}}
    <script src="{{asset('/assets/js/action.js')}}"></script>
    <script src="{{asset('/assets/js/custom/apps/app/app_list.js')}}"></script>
    @if (Agent::isMobile())
        @include('admin.layout.mobile')
    @endif
@endpush

