@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.list.headerPage', [
                         'breadcrumb_list' => 'bank/list',
                         'breadcrumb' => 'Banks',
                         'page' => 'List',
                         'pagetitle' => 'Danh sách thông tin ngân hàng của Users',
                         'linkadd' => 'bank/add',
                         'add' => 'Add New Bank'
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
                                                'headertitle' => 'List banking information of users',
                                                'searchholder' => 'account name, account number'
                                    ])

                                    {{-- Filters --}}
                                    <div class="hs-unfold mr-2">
                                        <a class="js-hs-unfold-invoker btn btn-white" href="javascript:;"
                                           data-hs-unfold-options='{"target": "#FilterDropdown","type": "css-animation",
                                           "smartPositionOff": true}'><i class="tio-filter-list mr-1"></i>Filter
                                        </a>

                                        <div id="FilterDropdown" style="min-width: 22rem;"
                                             class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right dropdown-card card-dropdown-filter-centered">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-header-title">Filter Bank Information</h5>

                                                    {{-- Toggle Button --}}
                                                    <a class="js-hs-unfold-invoker btn btn-icon btn-xs btn-ghost-secondary ml-2"
                                                       href="javascript:;" data-hs-unfold-options='{"target": "#FilterDropdown",
                                                       "type": "css-animation","smartPositionOff": true}'>
                                                        <i class="tio-clear tio-lg"></i>
                                                    </a>
                                                    {{-- End Toggle Button --}}
                                                </div>

                                                <div class="card-body">
                                                    <form id="filter">
                                                        <div class="form-row">
                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Bank name</small>
                                                                <select class="js-select2-custom custom-select" size="1"
                                                                        style="opacity: 0;" name="filter1" id="filter1"
                                                                        data-hs-select2-options='{
                                                                        "searchInputPlaceholder": "Search a bank name",
                                                                        "placeholder": "Chọn tên ngân hàng"}'>
                                                                    <option value=""></option>
                                                                    @foreach(config('bank.bank_name') as $moduleItem)
                                                                        <option
                                                                            value="{{$moduleItem}}">{{$moduleItem}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Branch</small>
                                                                <select class="js-select2-custom custom-select" size="1"
                                                                        style="opacity: 0;" name="filter2" id="filter2"
                                                                        data-hs-select2-options='{
                                                                          "placeholder": "Chọn chi nhánh ngân hàng",
                                                                          "searchInputPlaceholder": "Search a branch"}'>
                                                                    <option value=""></option>
                                                                    @foreach(config('bank.branch') as $moduleItem)
                                                                        <option
                                                                            value="{{$moduleItem}}">{{$moduleItem}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Email</small>
                                                                <select size="1" style="opacity: 0;" id="filter3"
                                                                        name="filter3"
                                                                        class="js-select2-custom custom-select"
                                                                        data-hs-select2-options='{
                                                                          "searchInputPlaceholder": "Nhập email"}'>
                                                                    <option value="">All user</option>
                                                                    @foreach($email as $e)
                                                                        <option
                                                                            value="{{$e->id}}">{{$e->email}}</option>
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
                                                                <a class="btn btn-block btn-soft-success" id="reset">
                                                                    <i class="tio-refresh"></i> Reset
                                                                </a>
                                                            </div>
                                                            <div class="col-sm form-group">
                                                                <a class="js-hs-unfold-invoker btn btn-block btn-primary apply"
                                                                   href="javascript:;" data-hs-unfold-options='{
                                                                    "target": "#slideFilterDropdown",
                                                                    "type": "css-animation",
                                                                    "smartPositionOff": true
                                                               }'>Apply</a>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Filters --}}

                                    {{-- Unfold Columns --}}
                                    <div class="hs-unfold mr-10 mr-xl-2">
                                        <a class="js-hs-unfold-invoker btn btn-white" href="javascript:;"
                                           data-hs-unfold-options='{"target": "#showHideDropdown", "type": "css-animation"}'>
                                            <i class="tio-table mr-1"></i> Columns
                                        </a>

                                        <div id="showHideDropdown" style="width: 15rem;"
                                             class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right dropdown-card">
                                            <div class="card card-sm">
                                                <div class="card-body">
                                                    @include('admin.layout.list.column.column', [
                                                                    'col2' => 'Username',
                                                                    'col3' => 'Email',
                                                                    'col4' => 'Account Name',
                                                                    'col5' => 'Account Number',
                                                                    'col6' => 'Bank Name',
                                                                    'col7' => 'Branch',
                                                                    'col8' => 'Create_at',
                                                                    'col9' => 'Update_at',
                                                                    'col10' => 'Action'
                                                        ])
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
    <script src="{{asset('/assets/js/custom/members/bank/bank_list.js')}}"></script>
    @if (Agent::isMobile())
        @include('admin.layout.mobile')
    @endif
@endpush
