@extends('admin.layout.index')
@section('content')
    <div id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.list.headerPageAjax', [
                        'breadcrumb_list' => 'task/tag/list',
                        'breadcrumb' => 'Task',
                        'page' => 'Tags',
                        'pagetitle' => 'Thẻ nhiệm vụ',
                        'target' => 'taskTagModal',
                        'action_title' => 'Add a new tag '
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
                                            'headertitle' => 'List Task Tags',
                                            'searchholder' => 'tên thẻ nhiệm vụ'
                                    ])

                                    {{-- Filters --}}
                                    <div class="hs-unfold mr-2">
                                        <a class="js-hs-unfold-invoker btn btn-white" href="javascript:;"
                                           data-hs-unfold-options='{"target": "#FilterDropdown","type": "css-animation",
                                           "smartPositionOff": true}'><i class="tio-filter-list mr-1"></i>Filter
                                        </a>

                                        <div id="FilterDropdown" style="min-width: 23rem;"
                                             class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right dropdown-card card-dropdown-filter-centered">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-header-title">Filter Task Tag</h5>

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
                                                        @include('admin.layout.list.filter.filterDateRow')

                                                        @include('admin.layout.list.filter.actionApply')
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Filters --}}

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
                                                    @include('admin.layout.list.column.col4', [
                                                                     'col2' => 'Tên thẻ nhiệm vụ',
                                                                     'col3' => 'Created_at',
                                                                     'col4' => 'Updated_at',
                                                                     'col5' => 'Action',
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

            {{-- Add Task Tag Modal --}}
            <div class="modal fade" id="taskTagModal" data-backdrop="static" tabindex="-1" role="dialog"
                 aria-labelledby="taskTagModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="addTaskTag">@csrf
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalHeading">Create a new task tag</h4>
                                <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary" data-dismiss="modal"
                                        aria-label="Close"><i class="tio-clear tio-lg"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group required">
                                    <label for="name" class="input-label">Tên thẻ nhiệm vụ</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                           placeholder="Nhập tên thẻ nhiệm vụ" value="{{ old('name') }}" maxlength="255">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Huỷ</button>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End Add Task Tag Modal --}}

            {{-- Update Task Tag Modal --}}
            <div class="modal fade" id="editTaskTagModal" data-backdrop="static" tabindex="-1" role="dialog"
                 aria-labelledby="editTaskTagModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <form id="editIncomeCategory">@csrf
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalHeading">Cập nhật thẻ nhiệm vụ</h4>
                                <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary"
                                        data-dismiss="modal"
                                        aria-label="Close"><i class="tio-clear tio-lg"></i></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group required">
                                    <label for="config_key1" class="input-label">Tên thẻ nhiệm vụ </label>
                                    <input type="text" class="form-control" id="name1" name="name" required
                                           placeholder="Nhập tên thẻ nhiệm vụ" value="{{ old('name') }}" maxlength="255">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-white" data-dismiss="modal">Huỷ</button>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End Update Expense Category Modal --}}
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
    {{$dataTable->scripts()}}
    <script src="{{asset('/assets/js/action.js')}}"></script>
    <script src="{{asset('/assets/js/custom/members/task/category.js')}}"></script>
    @if (Agent::isMobile())
        @include('admin.layout.mobile')
    @endif
@endpush


