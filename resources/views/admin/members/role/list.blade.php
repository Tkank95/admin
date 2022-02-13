@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.list.headerPage', [
                         'breadcrumb_list' => 'role/list',
                         'breadcrumb' => 'Roles',
                         'page' => 'List',
                         'pagetitle' => 'Danh sách Roles',
                         'linkadd' => 'role/add',
                         'add' => 'Add New Role'
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

                                    @include('admin.layout.list.headerForm', ['headertitle' => 'List Role', 'searchholder' => 'Role'])

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
                                                    <h5 class="card-header-title">Filter Role</h5>

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
                                    <div class="hs-unfold mr-2">
                                        <a class="js-hs-unfold-invoker btn btn-white" href="javascript:"
                                           data-hs-unfold-options='{"target": "#showHideDropdown", "type": "css-animation"}'>
                                            <i class="tio-table mr-1"></i> Columns
                                        </a>

                                        <div id="showHideDropdown" style="width: 15rem;"
                                             class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right dropdown-card">
                                            <div class="card card-sm">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="mr-2">Name</span>

                                                        {{-- Checkbox Switch --}}
                                                        <label class="toggle-switch toggle-switch-sm" for="col2">
                                                            <input type="checkbox" class="toggle-switch-input"
                                                                   id="col2" name="col2" checked="">
                                                            <span class="toggle-switch-label">
                                                                <span class="toggle-switch-indicator"></span></span>
                                                        </label>
                                                        {{-- End Checkbox Switch --}}
                                                    </div>

                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="mr-2">User</span>

                                                        {{-- Checkbox Switch --}}
                                                        <label class="toggle-switch toggle-switch-sm" for="col3">
                                                            <input type="checkbox" class="toggle-switch-input"
                                                                   id="col3" name="col3" checked="">
                                                            <span class="toggle-switch-label">
                                                                <span class="toggle-switch-indicator"></span></span>
                                                        </label>
                                                        {{-- End Checkbox Switch --}}
                                                    </div>

                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="mr-2">Mô tả</span>

                                                        {{-- Checkbox Switch --}}
                                                        <label class="toggle-switch toggle-switch-sm" for="col4">
                                                            <input type="checkbox" class="toggle-switch-input"
                                                                   id="col4" name="col4" checked="">
                                                            <span class="toggle-switch-label">
                                                                <span class="toggle-switch-indicator"></span></span>
                                                        </label>
                                                        {{-- End Checkbox Switch --}}
                                                    </div>

                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="mr-2">Created_at</span>

                                                        {{-- Checkbox Switch --}}
                                                        <label class="toggle-switch toggle-switch-sm" for="col5">
                                                            <input type="checkbox" class="toggle-switch-input"
                                                                   id="col5" name="col5" checked="">
                                                            <span class="toggle-switch-label">
                                                                <span class="toggle-switch-indicator"></span></span>
                                                        </label>
                                                        {{-- End Checkbox Switch --}}
                                                    </div>

                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="mr-2">Updated_at</span>

                                                        {{-- Checkbox Switch --}}
                                                        <label class="toggle-switch toggle-switch-sm" for="col6">
                                                            <input type="checkbox" class="toggle-switch-input"
                                                                   id="col6" name="col6" checked="">
                                                            <span class="toggle-switch-label">
                                                                <span class="toggle-switch-indicator"></span></span>
                                                        </label>
                                                        {{-- End Checkbox Switch --}}
                                                    </div>

                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="mr-2">Action</span>

                                                        {{-- Checkbox Switch --}}
                                                        <label class="toggle-switch toggle-switch-sm" for="col7">
                                                            <input type="checkbox" class="toggle-switch-input"
                                                                   id="col7" name="col7" checked="">
                                                            <span class="toggle-switch-label">
                                                                <span class="toggle-switch-indicator"></span></span>
                                                        </label>
                                                        {{-- End Checkbox Switch --}}
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
            </form>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
    {{$dataTable->scripts()}}
    <script src="{{asset('/assets/js/action.js')}}"></script>
    <script src="{{asset('/assets/js/custom/members/role.js')}}"></script>
    @if (Agent::isMobile())
        @include('admin.layout.mobile')
    @endif
@endpush
