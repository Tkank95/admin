@extends('admin.layout.index')
@section('content')
    <div id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.list.headerPage', [
                         'breadcrumb_list' => 'job/list',
                         'breadcrumb' => 'Apply Jobs',
                         'page' => 'List',
                         'pagetitle' => 'Danh sách đơn đăng ký',
                         'linkadd' => 'job/add',
                         'add' => 'Add New Apply Job'
                     ])
            {{-- End Page Header --}}

            {{-- Alert --}}
            @include('admin.layout.alert')
            {{-- End Alert --}}

            <form>
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3 mb-lg-5">
                            {{-- Header --}}
                            <div class="card-header" id="search-filter">
                                <div class="row justify-content-between align-items-center flex-grow-1">

                                    @include('admin.layout.list.headerForm', [
                                            'headertitle' => 'List Apply Job',
                                            'searchholder' => 'Team or ID in app'
                                    ])

                                    {{-- Unfold Filters --}}
                                    <div class="hs-unfold mr-2">
                                        <a class="js-hs-unfold-invoker btn btn-white" href="javascript:"
                                           data-hs-unfold-options='{"target": "#FilterDropdown", "type": "css-animation",
                                           "smartPositionOff": true}'><i class="tio-filter-list mr-1"></i> Filter
                                        </a>

                                        <div id="FilterDropdown" style="min-width: 22rem;"
                                             class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right dropdown-card card-dropdown-filter-centered">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-header-title">Filter Apply Job</h5>

                                                    {{-- Toggle Button --}}
                                                    <a class="js-hs-unfold-invoker btn btn-icon btn-xs btn-ghost-secondary ml-2"
                                                       href="javascript:" data-hs-unfold-options='{"target": "#FilterDropdown",
                                                       "type": "css-animation", "smartPositionOff": true}'>
                                                        <i class="tio-clear tio-lg"></i>
                                                    </a>
                                                    {{-- End Toggle Button --}}
                                                </div>

                                                <div class="card-body">
                                                    <form id="filter">
                                                        <div class="form-row">
                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Username</small>
                                                                <select size="1" style="opacity: 0;" id="filter1"
                                                                        class="js-select2-custom custom-select"
                                                                        name="filter1" data-hs-select2-options='{
                                                                          "searchInputPlaceholder": "Nhập username"}'>
                                                                    <option value="">All user</option>
                                                                    @foreach($users as $user)
                                                                        <option
                                                                            value="{{$user->user_id}}">{{$user->username}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Application</small>
                                                                <select size="1" style="opacity: 0;" id="filter2"
                                                                        class="js-select2-custom custom-select"
                                                                        name="filter2" data-hs-select2-options='{
                                                                          "searchInputPlaceholder": "Nhập tên app"}'>
                                                                    <option value="">All App</option>
                                                                    @foreach($apps as $app)
                                                                        <option
                                                                            value="{{$app->app_id}}">{{$app->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Ngày cast</small>
                                                                <input type="date" class="form-control" id="filter3"
                                                                       name="filter3">
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
                                                                    "target": "#slideFilterDropdown","type": "css-animation",
                                                                    "smartPositionOff": true}'>Apply</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Unfold Filters --}}

                                    {{-- Unfold Columns --}}
                                    <div class="hs-unfold">
                                        <a class="js-hs-unfold-invoker btn btn-white" href="javascript:"
                                           data-hs-unfold-options='{"target": "#showHideDropdown", "type": "css-animation"}'>
                                            <i class="tio-table mr-1"></i> Columns
                                        </a>

                                        <div id="showHideDropdown" style="width: 15rem;"
                                             class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right dropdown-card">
                                            <div class="card card-sm">
                                                <div class="card-body">
                                                    @include('admin.layout.list.column.column', [
                                                                'col2' => 'Username',
                                                                'col3' => 'Category',
                                                                'col4' => 'App',
                                                                'col5' => 'ID in app',
                                                                'col6' => 'Team',
                                                                'col7' => 'Ngày cast',
                                                                'col8' => 'Kết quả',
                                                                'col9' => 'Lương cứng',
                                                                'col10' => 'Created_at'

                                                    ])
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="mr-2">Updated_at</span>
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
                            {{-- End Header --}}

                            {{-- Table --}}
                            <div class="table-responsive datatable-custom ">
                                {{$dataTable->table()}}
                            </div>
                            {{-- End Table --}}

                            {{-- Footer --}}
                            @include('admin.layout.list.tableFooter10')
                            {{-- End Footer --}}

                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
    {{$dataTable->scripts()}}
    <script src="{{asset('/assets/js/action.js')}}"></script>
    <script src="{{asset('/assets/js/custom/data/apply_job/applyJob_list.js')}}"></script>
    @if (Agent::isMobile())
        @include('admin.layout.mobile')
    @endif
@endpush


