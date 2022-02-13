@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.list.headerPageAjax', [
                         'breadcrumb_list' => 'config/list',
                         'breadcrumb' => 'Pages',
                         'page' => 'Setting',
                         'pagetitle' => 'Config Setting Page',
                         'target' => 'configPageModal',
                         'action_title' => 'Add Config Setting Page'
                     ])
            {{-- End Page Header --}}

            @include('admin.layout.alert')
            {{-- Add Config Modal --}}
            <div class="modal fade" id="configPageModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalHeading">Create New Config Setting Page</h4>
                            <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary" data-dismiss="modal"
                                    aria-label="Close"><i class="tio-clear tio-lg"></i></button>
                        </div>
                        <div class="modal-body">
                            <form id="addConfigPage" name="addConfigPage" class="form-horizontal">
                                @csrf
                                <div class="form-group required">
                                    <label for="config_key" class="input-label">Config Key</label>
                                    <input type="text" class="form-control" id="config_key" name="config_key"
                                           placeholder="Nhập config_key" value="{{ old('config_key') }}" maxlength="100"
                                           required="">
                                </div>
                                <div class="form-group required">
                                    <label for="config_value" class="input-label">Config Value</label>
                                    <input type="text" class="form-control tinymce" id="config_value"
                                           name="config_value" placeholder="Nhập Config Value"
                                           value="{{ old('config_value') }}" required="">
                                </div>

                                <div class="form-group">
                                    <label for="config_value1" class="input-label">Convert Value to HTML</label>
                                    <textarea class="form-control tinymce" placeholder="Nhập nội dung"></textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Config Setting Page</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Add Config Modal --}}

            {{-- Update Config Modal --}}
            <div class="modal fade" id="editConfigPageModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="modalHeading">Update Config Setting Page</h4>
                            <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary" data-dismiss="modal"
                                    aria-label="Close"><i class="tio-clear tio-lg"></i></button>
                        </div>
                        <div class="modal-body">
                            <form id="editConfigPage" name="editConfigPage" class="form-horizontal">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <div class="form-group required">
                                    <label for="config_key1" class="input-label">Config Key</label>
                                    <input type="text" class="form-control" id="config_key1" name="config_key1"
                                           placeholder="Nhập config_key" value="" maxlength="100" required="">
                                </div>
                                <div class="form-group required">
                                    <label for="config_value1" class="input-label">Config Value</label>
                                    <input type="text" class="form-control tinymce" id="config_value1"
                                           name="config_value1" placeholder="Nhập Config_Value" value="" required="">
                                </div>

                                <div class="form-group">
                                    <label for="config_value1" class="input-label">Convert Value to HTML</label>
                                    <textarea class="form-control tinymce" placeholder="Nhập nội dung"></textarea>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Update Config Setting Page</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            {{-- End Update Config Modal --}}

            <form method="post" id="ConfigPageListForm">
                @csrf
                <div class="row ">
                    <div class="col-lg-12">
                        <div class="card mb-3 mb-lg-5">
                            {{-- Header --}}
                            <div class="card-header" id="search-filter">
                                <div class="row justify-content-between align-items-center flex-grow-1">
                                    @include('admin.layout.list.headerForm', ['headertitle' => 'List Config Setting Page', 'searchholder' => 'Config Setting Page'])

                                    {{-- Unfold Filters --}}
                                    <div class="hs-unfold mr-2">
                                        <a class="js-hs-unfold-invoker btn btn-white" href="javascript:"
                                           data-hs-unfold-options='{"target": "#FilterDropdown", "type": "css-animation",
                                           "smartPositionOff": true}'><i class="tio-filter-list mr-1"></i> Filter
                                        </a>

                                        <div id="FilterDropdown" style="min-width: 23rem;"
                                             class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right dropdown-card card-dropdown-filter-centered">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-header-title">Filter Config</h5>

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
                                                        @include('admin.layout.list.filter.filterDateRow')

                                                        @include('admin.layout.list.filter.actionApply')
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
                                                    @include('admin.layout.list.column.col4', [
                                                                    'col2' => 'Config Key',
                                                                    'col3' => 'Config Value',
                                                                    'col4' => 'Created_at',
                                                                    'col5' => 'Updated_at',
                                                    ])

                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="mr-2">Action</span>

                                                        {{-- Checkbox Switch --}}
                                                        <label class="toggle-switch toggle-switch-sm" for="col6">
                                                            <input type="checkbox" class="toggle-switch-input"
                                                                   id="col6" name="col6" checked="">
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
    </main>
@endsection

@section('js')
    <script src="{{asset('/assets/js/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
    {{$dataTable->scripts()}}
    <script src="{{asset('/assets/js/action.js')}}"></script>
    <script src="{{asset('/assets/js/custom/config_page/config_setting_page.js')}}"></script>
    @if (Agent::isMobile())
        @include('admin.layout.mobile')
    @endif
@endsection

