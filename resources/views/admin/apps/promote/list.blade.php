@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.list.headerPage', [
                         'breadcrumb_list' => 'promote/list',
                         'breadcrumb' => 'Promote Application',
                         'page' => 'List',
                         'pagetitle' => 'Quảng bá ứng dụng',
                         'linkadd' => 'promote/add',
                         'add' => 'Add New Promote'
                     ])
            {{-- End Page Header --}}

            @include('admin.layout.alert')

            <form>
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3 mb-lg-5">
                            <div class="card-header" id="search-filter">
                                <div class="row justify-content-between align-items-center flex-grow-1">

                                    @include('admin.layout.list.headerForm', [
                                                'headertitle' => 'List Promote',
                                                'searchholder' => 'tiêu đề, nội dung đề xuất'
                                    ])

                                    {{-- Filters --}}
                                    <div class="hs-unfold mr-2">
                                        <a class="js-hs-unfold-invoker btn btn-white" href="javascript:;"
                                           data-hs-unfold-options='{"target": "#FilterDropdown","type": "css-animation",
                                           "smartPositionOff": true}'><i class="tio-filter-list mr-1"></i>Filter
                                        </a>

                                        <div id="FilterDropdown" style="min-width: 25rem;"
                                             class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right dropdown-card card-dropdown-filter-centered">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-header-title">Filter Promote Application</h5>

                                                    {{-- Toggle Button--}}
                                                    <a class="js-hs-unfold-invoker btn btn-icon btn-xs btn-ghost-secondary ml-2"
                                                       href="javascript:" data-hs-unfold-options='{"target": "#FilterDropdown",
                                                       "type": "css-animation","smartPositionOff": true}'>
                                                        <i class="tio-clear tio-lg"></i>
                                                    </a>
                                                    {{-- End Toggle Button--}}
                                                </div>

                                                <div class="card-body">
                                                    <form id="filter">
                                                        <div class="form-row">
                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Thể loại</small>
                                                                <select class="js-select2-custom custom-select" size="1"
                                                                        style="opacity: 0;" name="filter1" id="filter1"
                                                                        data-hs-select2-options='{"minimumResultsForSearch": "Infinity"}'>
                                                                    <option value="">All Category</option>
                                                                    @foreach($menus as $cate)
                                                                        <option
                                                                            value="{{ $cate->id }}">{{ $cate->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Ứng dụng</small>
                                                                <select class="js-select2-custom custom-select" size="1"
                                                                        style="opacity: 0;" name="filter2" id="filter2"
                                                                        data-hs-select2-options='{"minimumResultsForSearch": "Infinity"}'>
                                                                    <option value="">All Application</option>
                                                                    @foreach($applications as $app)
                                                                        <option
                                                                            value="{{$app->id}}">{{$app->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Start Date</small>
                                                                <div
                                                                    class="js-flatpickr flatpickr-custom input-group input-group-merge"
                                                                    id="dateStart" data-hs-flatpickr-options='{"appendTo": "#dateStart",
                                                                     "dateFormat": "Y/m/d","wrap": true}'>
                                                                    <div class="input-group-prepend" data-toggle="">
                                                                        <div class="input-group-text">
                                                                            <i class="tio-calendar-month"></i>
                                                                        </div>
                                                                    </div>

                                                                    <input type="text" id="start_date" name="start_date"
                                                                           class="flatpickr-custom-form-control form-control"
                                                                           placeholder="Ngày bắt đầu" data-input=""
                                                                           value="{{old('start_date')}}">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">End Date</small>
                                                                <div
                                                                    class="js-flatpickr flatpickr-custom input-group input-group-merge"
                                                                    id="dateEnd" data-hs-flatpickr-options='{"appendTo": "#dateEnd",
                                                                    "dateFormat": "Y/m/d","wrap": true}'>
                                                                    <div class="input-group-prepend" data-toggle="">
                                                                        <div class="input-group-text">
                                                                            <i class="tio-calendar-month"></i>
                                                                        </div>
                                                                    </div>

                                                                    <input type="text" id="end_date" name="end_date"
                                                                           class="flatpickr-custom-form-control form-control"
                                                                           placeholder="Ngày kết thúc" data-input=""
                                                                           value="{{old('end_date')}}">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Status</small>
                                                                <select
                                                                    class="js-select2-custom js-datatable-filter custom-select"
                                                                    size="1" style="opacity: 0;" id="filter3" name="filter3"
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
                                                                <a class="btn btn-block btn-soft-success" id="reset">
                                                                    <i class="tio-refresh"></i> Reset
                                                                </a>
                                                            </div>
                                                            <div class="col-sm form-group">
                                                                <a class="js-hs-unfold-invoker btn btn-block btn-primary apply"
                                                                   href="javascript:;" data-hs-unfold-options='{
                                                                    "target": "#slideFilterDropdown","type": "css-animation",
                                                                    "smartPositionOff": true}'>Apply</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Filters --}}

                                    {{-- Unfold Columns --}}
                                    <div class="hs-unfold">
                                        <a class="js-hs-unfold-invoker btn btn-white" href="javascript:;"
                                           data-hs-unfold-options='{"target": "#showHideDropdown", "type": "css-animation"}'>
                                            <i class="tio-table mr-1"></i> Columns
                                        </a>

                                        <div id="showHideDropdown" style="width: 15rem;"
                                             class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right dropdown-card">
                                            <div class="card card-sm">
                                                <div class="card-body">
                                                    @include('admin.layout.list.column.column', [
                                                                    'col2' => 'Thể loại',
                                                                    'col3' => 'Ứng dụng',
                                                                    'col4' => 'Banner',
                                                                    'col5' => 'Tiêu đề',
                                                                    'col6' => 'Nội dung',
                                                                    'col7' => 'HD đăng ký',
                                                                    'col8' => 'Trạng thái',
                                                                    'col9' => 'Create_at',
                                                                    'col10' => 'Update_at'
                                                        ])
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="mr-2">Action</span>
                                                        <label class="toggle-switch toggle-switch-sm" for="col11">
                                                            <input type="checkbox" class="toggle-switch-input" id="col11" checked="">
                                                            <span class="toggle-switch-label"><span class="toggle-switch-indicator"></span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Unfold Columns --}}
                                </div>
                            </div>
                            {{-- End Form Header --}}

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
            </form>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
    {{$dataTable->scripts()}}
    <script src="{{asset('/assets/js/action.js')}}"></script>
    <script src="{{asset('/assets/js/custom/apps/promote/promote_list.js')}}"></script>
    @if (Agent::isMobile())
        @include('admin.layout.mobile')
    @endif
@endpush
