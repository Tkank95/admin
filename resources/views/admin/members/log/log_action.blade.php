@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            @include('admin.layout.alert')

            <form id="list">
                @csrf
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="card mb-3 mb-lg-5">
                            {{-- Header --}}
                            <div class="card-header" id="search-filter">
                                <div class="row justify-content-between align-items-center flex-grow-1">

                                    @include('admin.layout.list.headerForm', ['headertitle' => 'List Log Action', 'searchholder' => 'url, ip address'])

                                    {{-- Unfold Filters --}}
                                    <div class="hs-unfold mr-2">
                                        <a class="js-hs-unfold-invoker btn btn-white" href="javascript:;"
                                           data-hs-unfold-options='{"target": "#FilterDropdown", "type": "css-animation",
                                           "smartPositionOff": true}'><i class="tio-filter-list mr-1"></i> Filter
                                        </a>

                                        <div id="FilterDropdown" style="min-width: 30rem;"
                                             class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right dropdown-card card-dropdown-filter-centered">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-header-title">Filter Log Action</h5>

                                                    {{-- Toggle Button --}}
                                                    <a class="js-hs-unfold-invoker btn btn-icon btn-xs btn-ghost-secondary ml-2"
                                                       href="javascript:;" data-hs-unfold-options='{
                                                       "target": "#FilterDropdown", "type": "css-animation",
                                                       "smartPositionOff": true}'><i class="tio-clear tio-lg"></i>
                                                    </a>
                                                    {{-- End Toggle Button --}}
                                                </div>

                                                <div class="card-body">
                                                    <form id="filter">
                                                        <div class="form-row">
                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Log name</small>
                                                                <select class="js-select2-custom custom-select" size="1"
                                                                        style="opacity: 0;" name="filter1" id="filter1"
                                                                        data-hs-select2-options='{
                                                                          "placeholder": "Chọn log name",
                                                                          "searchInputPlaceholder": "Nhập log name"}'>
                                                                    <option value=""></option>
                                                                    @foreach($logname as $name)
                                                                        <option
                                                                            value="{{$name->log_name}}">{{$name->log_name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">User</small>
                                                                <select class="js-select2-custom custom-select" size="1"
                                                                        style="opacity: 0;" name="filter2" id="filter2"
                                                                        data-hs-select2-options='{
                                                                          "placeholder": "Chọn username",
                                                                          "searchInputPlaceholder": "Nhập username"}'>
                                                                    <option value=""></option>
                                                                    @foreach($users as $user)
                                                                        <option
                                                                            value="{{$user->causer_id}}">{{$user->username}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Description</small>
                                                                <select class="js-select2-custom custom-select" size="1"
                                                                        style="opacity: 0;" name="filter3" id="filter3"
                                                                        data-hs-select2-options='{
                                                                          "placeholder": "Chọn mô tả",
                                                                          "searchInputPlaceholder": "Nhập mô tả"}'>
                                                                    <option value=""></option>
                                                                    @foreach($description as $des)
                                                                        <option
                                                                            value="{{$des->description}}">{{$des->description}}</option>
                                                                    @endforeach
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
                                                                <a class="btn btn-block btn-soft-success"
                                                                   id="reset"><i class="tio-refresh"></i> Reset
                                                                </a>
                                                            </div>
                                                            <div class="col-sm form-group">
                                                                <a class="js-hs-unfold-invoker btn btn-block btn-primary apply"
                                                                   href="javascript:;" data-hs-unfold-options='{
                                                                   "target": "#slideFilterDropdown", "type": "css-animation",
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
                                        <a class="js-hs-unfold-invoker btn btn-white" href="javascript:;"
                                           data-hs-unfold-options='{"target": "#showHideDropdown", "type": "css-animation"}'>
                                            <i class="tio-table mr-1"></i> Columns
                                        </a>

                                        <div id="showHideDropdown" style="width: 15rem;"
                                             class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right dropdown-card">
                                            <div class="card card-sm">
                                                <div class="card-body">
                                                    @include('admin.layout.list.column.column', [
                                                                'col2' => 'Log Name',
                                                                'col3' => 'Mô tả',
                                                                'col4' => 'Url',
                                                                'col5' => 'Sub ID',
                                                                'col6' => 'Username',
                                                                'col7' => 'Chức vụ',
                                                                'col8' => 'Ip address',
                                                                'col9' => 'Device',
                                                                'col10' => 'Created_at'
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Unfold Columns --}}
                                </div>
                            </div>
                            {{-- End Header --}}

                            {{-- Table --}}
                            <div class="table-responsive datatable-custom">
                                {{$dataTable->table()}}
                            </div>
                            {{-- End Table --}}

                            {{-- Footer --}}
                            @include('admin.layout.list.tableFooter10')
                            {{-- End Footer --}}
                        </div>
                    </div>
                </div>

                {{-- Show detail Modal --}}
                <div class="modal fade" id="logDetail" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalHeading"></h4>
                                <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary" aria-label="Close"
                                        data-dismiss="modal"><i class="tio-clear tio-lg"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="card mb-3 mb-lg-5">
                                            <div class="card-header">
                                                <h4 class="card-header-title">Action info</h4>
                                            </div>

                                            <div class="card-body">
                                                <div class="text-md-left">
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Log name:</dt>
                                                        <dd class="col-md-auto" id="logName"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Mô tả:</dt>
                                                        <dd class="col-md-auto" id="logDescription"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Sub ID:</dt>
                                                        <dd class="col-md-auto" id="logSubId"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">User ID:</dt>
                                                        <dd class="col-md-auto" id="logUserId"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Method:</dt>
                                                        <dd class="col-md-auto" id="logMethod"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Ip:</dt>
                                                        <dd class="col-md-auto" id="logIp"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Time:</dt>
                                                        <dd class="col-md-auto" id="logTime"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-auto">Url:</dt>
                                                        <dd class="col-md-auto" id="logUrl"></dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="card mb-3 mb-lg-5">
                                            <div class="card-header">
                                                <h4 class="card-header-title">User info</h4>
                                            </div>

                                            <div class="card-body">
                                                <div class="text-md-left">
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Full name:</dt>
                                                        <dd class="col-md-auto" id="logFullName"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Username:</dt>
                                                        <dd class="col-md-auto" id="logUsername"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Email:</dt>
                                                        <dd class="col-md-auto" id="logEmail"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Trạng thái:</dt>
                                                        <dd class="col-md-auto" id="logStatus"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Position:</dt>
                                                        <dd class="col-md-auto" id="logPosition"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Banned:</dt>
                                                        <dd class="col-md-auto" id="logBanned"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Create:</dt>
                                                        <dd class="col-md-auto" id="logCreate"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Update:</dt>
                                                        <dd class="col-md-auto" id="logUpdate"></dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="card mb-3 mb-lg-5">
                                            <div class="card-header">
                                                <h4 class="card-header-title">Device</h4>
                                            </div>

                                            <div class="card-body">
                                                <div class="text-md-left">
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Type:</dt>
                                                        <dd class="col-md-auto" id="logType"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Platform:</dt>
                                                        <dd class="col-md-auto" id="logPlatForm"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Plat_Ver:</dt>
                                                        <dd class="col-md-auto" id="logPlatFormVersion"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Device:</dt>
                                                        <dd class="col-md-auto" id="logDevice"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Browser:</dt>
                                                        <dd class="col-md-auto" id="logBrowser"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Browser_V:</dt>
                                                        <dd class="col-md-auto" id="logBrowserVersion"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Languages:</dt>
                                                        <dd class="col-md-auto" id="logLanguages"></dd>
                                                    </dl>
                                                    <dl class="row">
                                                        <dt class="col-sm-4">Robot:</dt>
                                                        <dd class="col-md-auto" id="logRobot"></dd>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-header-title">Properties</h4>
                                        </div>

                                        <div class="card-body">
                                            <div class="text-md-left">
                                                <dl class="row">
                                                    <dt class="col-sm-auto">Agent:</dt>
                                                    <dd class="col-md-auto" id="logAgent"></dd>
                                                </dl>
                                                <dl class="row">
                                                    <dt class="col-sm-auto">Match:</dt>
                                                    <dd class="col-md-auto" id="logMatch"></dd>
                                                </dl>
                                                <div class="card-header" id="dataOld">
                                                    <h5 class="card-header-title" style="color: red">Data Old</h5>
                                                </div>
                                                <div id="old" class="mt-3"></div>
                                                <div class="card-header" id="dataNew">
                                                    <h5 class="card-header-title" style="color: red">Data New</h5>
                                                </div>
                                                <div id="new" class="mt-3"></div>
                                                <div class="card-header" id="dataDeleted" style="display: none">
                                                    <h5 class="card-header-title" style="color: red">Data Deleted</h5>
                                                </div>
                                                <div id="deleted" class="mt-3"></div>
                                                <div class="card-header" id="dataAuth" style="display: none">
                                                    <h5 class="card-header-title" style="color: red">Data Auth</h5>
                                                </div>
                                                <div id="auth" class="mt-3"></div>
                                                <div class="card-header" id="dataDetail" style="display: none">
                                                    <h5 class="card-header-title" style="color: red">Data Detail</h5>
                                                </div>
                                                <div id="showDetail" class="mt-3"></div>
                                                <div class="card-header" id="dataExport" style="display: none">
                                                    <h5 class="card-header-title" style="color: red">Data Export</h5>
                                                </div>
                                                <div id="showExport" class="mt-3"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Show detail Modal --}}
            </form>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
    {{$dataTable->scripts()}}
    <script src="{{asset('/assets/js/action.js')}}"></script>
    <script src="{{asset('/assets/js/custom/members/log/log_action.js')}}"></script>
    @if (Agent::isMobile())
        @include('admin.layout.mobile')
    @endif
@endpush

