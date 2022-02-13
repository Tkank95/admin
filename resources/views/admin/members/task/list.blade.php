@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.list.headerPageAjax', [
                        'breadcrumb_list' => 'task/list',
                        'breadcrumb' => 'Task',
                        'page' => 'List',
                        'pagetitle' => 'Danh sách công việc, nhiệm vụ',
                        'target' => 'taskModal',
                        'action_title' => 'Add Task'
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
                                    {{-- Filters Date --}}
                                    <div class="mt-2 mt-lg-auto">
                                        <!-- Nav -->
                                        <input type="hidden" name="filterDateStart" id="filterDateStart">
                                        <ul class="nav nav-segment btn" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active filterDateStart" data-filter-start="all-time" data-toggle="tab" id="all-time"  href="javascript:" role="tab">
                                                    All time
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link filterDateStart" id="daily" data-start="daily" data-toggle="tab" href="javascript:" role="tab">
                                                    Daily
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link filterDateStart" id="weekly" data-start="weekly" data-toggle="tab" href="javascript:" role="tab">
                                                    Weekly
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link filterDateStart" id="monthly" data-start="monthly" data-toggle="tab" href="javascript:" role="tab">
                                                    Monthly
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link filterDateStart" id="yearly" data-start="yearly" data-toggle="tab" href="javascript:" role="tab">
                                                    Yearly
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- End Nav -->
                                    </div>
                                    {{-- End Filters Date --}}

                                    @include('admin.layout.list.headerForm', ['headertitle' => '','searchholder' => 'tên hoặc loại nhiệm vụ, địa điểm, ghi chú'])

                                    {{-- Filters --}}
                                    <div class="hs-unfold mr-2">
                                        <a class="js-hs-unfold-invoker btn btn-white" href="javascript:"
                                           data-hs-unfold-options='{"target": "#FilterDropdown","type": "css-animation",
                                           "smartPositionOff": true}'><i class="tio-filter-list mr-1"></i>Filter
                                        </a>

                                        <div id="FilterDropdown" style="min-width: 25rem;"
                                             class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right dropdown-card card-dropdown-filter-centered">
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5 class="card-header-title">Filter Task</h5>

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
                                                                <small class="text-cap mb-2">Username</small>
                                                                <select class="custom-select select-search" size="1"
                                                                        style="opacity: 0;" name="filter1" id="filter1">
                                                                </select>
                                                            </div>
                                                        </div>

                                                        @include('admin.layout.list.filter.filterDate')

                                                        <div class="form-row">
                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">DeadLine</small>
                                                                <div
                                                                    class="js-flatpickr flatpickr-custom input-group input-group-merge"
                                                                    id="dateDue" data-hs-flatpickr-options='{"appendTo": "#dateDue",
                                                                     "dateFormat": "Y-m-d","wrap": true}'>
                                                                    <div class="input-group-prepend" data-toggle="">
                                                                        <div class="input-group-text">
                                                                            <i class="tio-calendar-month"></i>
                                                                        </div>
                                                                    </div>

                                                                    <input type="text" id="filter3" name="filter3"
                                                                           class="flatpickr-custom-form-control form-control"
                                                                           placeholder="Ngày xong"
                                                                           data-input="" value="{{old('filter3')}}">
                                                                </div>
                                                            </div>

                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Status</small>
                                                                <select
                                                                    class="js-select2-custom js-datatable-filter custom-select"
                                                                    size="1" style="opacity: 0;" id="filter2"
                                                                    name="filter2"
                                                                    data-hs-select2-options='{"minimumResultsForSearch": "Infinity"}'>
                                                                    <option value="">All status</option>
                                                                    <option value="1"
                                                                            data-option-template='<span class="legend-indicator bg-info"></span>Open'>
                                                                        Open
                                                                    </option>
                                                                    <option value="3"
                                                                            data-option-template='<span class="legend-indicator bg-danger"></span>Closed'>
                                                                        Closed
                                                                    </option>
                                                                    <option value="2"
                                                                            data-option-template='<span class="legend-indicator bg-primary"></span>In progress'>
                                                                        In progress
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        @include('admin.layout.list.filter.actionApply')
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Filters --}}

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
                                                    @include('admin.layout.list.column.column', [
                                                                     'col2' => 'Username',
                                                                     'col3' => 'Thẻ nhiệm vụ',
                                                                     'col4' => 'Tên nhiệm vụ',
                                                                     'col5' => 'Ngày giao',
                                                                     'col6' => 'Deadline',
                                                                     'col7' => 'Trạng thái',
                                                                     'col8' => 'Repeat',
                                                                     'col9' => 'File',
                                                                     'col10' => 'Địa điểm'
                                                     ])
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="mr-2">Ghi chú</span>
                                                        <label class="toggle-switch toggle-switch-sm" for="col11">
                                                            <input type="checkbox" class="toggle-switch-input" id="col11" checked="">
                                                            <span class="toggle-switch-label"><span class="toggle-switch-indicator"></span></span>
                                                        </label>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <span class="mr-2">Action</span>
                                                        <label class="toggle-switch toggle-switch-sm" for="col12">
                                                            <input type="checkbox" class="toggle-switch-input" id="col12" checked="">
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

            {{-- Add Task Modal --}}
            <div class="modal fade" id="taskModal" data-backdrop="static" tabindex="-1" role="dialog"
                 aria-labelledby="taskModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form id="addTask" method="post" enctype="multipart/form-data">@csrf
                            <div class="modal-header">
                                <textarea id="name" name="name" class="form-control form-control-title" rows="1"
                                          autocomplete="name" required value="{{old('name')}}"
                                          placeholder="Nhập tên công việc, nhiệm vụ"></textarea>

                                <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary"
                                        data-dismiss="modal" aria-label="Close"><i class="tio-clear tio-lg"></i>
                                </button>
                            </div>

                            <div class="modal-body">
                                <div class="form-group required">
                                    <label for="tag_id" class="input-label">Loại công việc, nhiệm vụ</label>
                                    <select class="js-select2-custom custom-select" size="1"
                                            style="opacity: 0;" name="tag_id" id="tag_id"
                                            data-hs-select2-options='{"searchInputPlaceholder": "Tìm kiếm thẻ nhiệm vụ"}'>
                                        <option value="">All Task Tags</option>
                                        @foreach($category as $cate)
                                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group required">
                                            <label for="user_id" class="input-label">Người thực hiện</label>
                                            <select class="select-search custom-select" size="1"
                                                    style="opacity: 0;" name="user_id" id="user_id">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group required">
                                            <label for="location" class="input-label">Địa điểm</label>
                                            <input type="text" class="form-control" id="location" name="location"
                                                   placeholder="Vị trí thực hiện" value="{{ old('location') }}"
                                                   aria-label="Add location">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group required">
                                            <label for="status" class="input-label">Status</label>
                                            <select class="js-select2-custom js-datatable-filter custom-select"
                                                    size="1" style="opacity: 0;" id="status" name="status" required
                                                    data-hs-select2-options='{"minimumResultsForSearch": "Infinity"}'>
                                                <option value="1" selected data-option-template='<span class="
                                                        legend-indicator bg-info"></span>Open'>Open
                                                </option>
                                                <option value="3" data-option-template='<span class="legend-indicator
                                                        bg-danger"></span>Closed'>Closed
                                                </option>
                                                <option value="2" data-option-template='<span class="legend-indicator
                                                        bg-primary"></span>In progress'>In progress
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group required">
                                            <label for="start" class="input-label">Ngày bắt đầu</label>
                                            <div class="js-flatpickr flatpickr-custom input-group input-group-merge"
                                                 id="deadLineStart" data-hs-flatpickr-options='{"appendTo": "#deadLineStart",
                                                    "defaultDate": "{{now()}}","dateFormat": "Y-m-d H:i:ss","wrap": true, "enableTime": true, "time_24hr": true}'>
                                                <div class="input-group-prepend" data-toggle="">
                                                    <div class="input-group-text"><i class="tio-calendar-month"></i>
                                                    </div>
                                                </div>

                                                <input type="text" id="start" name="start" data-input=""
                                                       class="flatpickr-custom-form-control form-control" required
                                                       placeholder="Ngày giao nhiệm vụ" value="{{ old('start') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group required">
                                            <label for="end" class="input-label">Deadline</label>
                                            <div class="js-flatpickr flatpickr-custom input-group input-group-merge"
                                                 id="deadLineEnd" data-hs-flatpickr-options='{"appendTo": "#deadLineEnd",
                                                    "dateFormat": "Y-m-d H:i:ss","wrap": true, "enableTime": true, "time_24hr": true}'>
                                                <div class="input-group-prepend" data-toggle="">
                                                    <div class="input-group-text"><i class="tio-calendar-month"></i>
                                                    </div>
                                                </div>

                                                <input type="text" id="end" name="end" data-input=""
                                                       class="flatpickr-custom-form-control form-control" required
                                                       placeholder="Hạn hoàn thành" value="{{ old('end') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group required">
                                            <label for="repeat" class="input-label">Lặp lại</label>
                                            <!-- Select -->
                                            <select class="js-select2-custom custom-select" id="repeat" name="repeat"
                                                    data-hs-select2-options='{"minimumResultsForSearch": "Infinity"}'>
                                                <option value="" selected>Select Repeat</option>
                                                <option value="0">Never</option>
                                                <option value="1">Everyday</option>
                                                <option value="2">Weekdays</option>
                                                <option value="3">Monthly</option>
                                            </select>
                                            <!-- End Select -->
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5">
                                        <label for="attachment" class="input-label">Tệp đính kèm
                                            <i class="tio-help-outlined text-body ml-1" data-toggle="tooltip"
                                               data-placement="top" title="Chỉ tải lên 1 tệp, nếu nhiều tệp thì nén lại
                                               rồi tải lên, các tệp được chấp nhận: image,.xlsx,.xls,.pdf,.doc,.docx">
                                            </i>
                                        </label>
                                        <div id="attachFiles" class="js-dropzone dropzone-custom custom-file-boxed">
                                            <div class="dz-message custom-file-boxed-label">
                                                <img class="avatar avatar-xl avatar-4by3 mb-3" alt="Tệp đính kèm"
                                                     src="../assets/svg/illustrations/browse.svg">
                                                <h6>Drag and drop your file here</h6>
                                                <p class="mb-2">or</p>
                                                <span class="btn btn-sm btn-primary">Browse files</span>
                                            </div>
                                        </div>
                                        <input type="hidden" class="upload" id="attachment" name="attachment">
                                    </div>

                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <label for="description" class="input-label">Ghi chú</label>
                                            <textarea class="form-control" id="description" name="description" rows="12"
                                                      placeholder="Mô tả thông tin chi tiết"
                                                      value="{{ old('description') }}"></textarea>
                                        </div>
                                    </div>
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
            {{-- End Add Task Modal --}}

            {{-- Update Task Modal --}}
            <div class="modal fade" id="editTaskModal" data-backdrop="static" tabindex="-1" role="dialog"
                 aria-labelledby="editTaskModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form id="editTask" method="post" enctype="multipart/form-data">@csrf
                            <div class="modal-header">
                                <textarea id="name1" name="name" class="form-control form-control-title" rows="1"
                                          autocomplete="name" required value="{{old('name')}}"
                                          placeholder="Nhập tên công việc, nhiệm vụ"></textarea>

                                <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary"
                                        data-dismiss="modal" aria-label="Close"><i class="tio-clear tio-lg"></i>
                                </button>
                            </div>

                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <div class="form-group required">
                                    <label for="tag_id1" class="input-label">Loại công việc, nhiệm vụ</label>
                                    <select class="js-select2-custom custom-select" size="1"
                                            style="opacity: 0;" name="tag_id" id="tag_id1"
                                            data-hs-select2-options='{"searchInputPlaceholder": "Tìm kiếm thẻ nhiệm vụ"}'>
                                        <option value="">All Task Tags</option>
                                        @foreach($category as $cate)
                                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="form-group required">
                                            <label for="user_id1" class="input-label">Người thực hiện</label>
                                            <select class="select-search custom-select" size="1"
                                                    style="opacity: 0;" name="user_id" id="user_id1">
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group required">
                                            <label for="location1" class="input-label">Địa điểm</label>
                                            <input type="text" class="form-control" id="location1" name="location"
                                                   placeholder="Vị trí thực hiện" value="{{old('location')}}"
                                                   aria-label="Add location">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group required">
                                            <label for="status1" class="input-label">Status</label>
                                            <select class="js-select2-custom js-datatable-filter custom-select"
                                                    size="1" style="opacity: 0;" id="status1" name="status" required
                                                    data-hs-select2-options='{"minimumResultsForSearch": "Infinity"}'>
                                                <option value="1" selected data-option-template='<span class="
                                                        legend-indicator bg-info"></span>Open'>Open
                                                </option>
                                                <option value="3" data-option-template='<span class="legend-indicator
                                                        bg-danger"></span>Closed'>Closed
                                                </option>
                                                <option value="2" data-option-template='<span class="legend-indicator
                                                        bg-primary"></span>In progress'>In progress
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group required">
                                            <label for="start1" class="input-label">Ngày bắt đầu</label>
                                            <div class="js-flatpickr flatpickr-custom input-group input-group-merge"
                                                 id="deadLineStart1" data-hs-flatpickr-options='{"appendTo": "#deadLineStart1",
                                                    "dateFormat": "Y-m-d H:i:ss","wrap": true, "enableTime": true, "time_24hr": true}'>
                                                <div class="input-group-prepend" data-toggle="">
                                                    <div class="input-group-text"><i class="tio-calendar-month"></i>
                                                    </div>
                                                </div>

                                                <input type="text" id="start1" name="start" data-input=""
                                                       class="flatpickr-custom-form-control form-control" required
                                                       placeholder="Ngày giao nhiệm vụ" value="{{ old('start') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group required">
                                            <label for="end1" class="input-label">Deadline</label>
                                            <div class="js-flatpickr flatpickr-custom input-group input-group-merge"
                                                 id="deadLineEnd1" data-hs-flatpickr-options='{"appendTo": "#deadLineEnd1",
                                                    "dateFormat": "Y-m-d H:i:ss","wrap": true, "enableTime": true, "time_24hr": true}'>
                                                <div class="input-group-prepend" data-toggle="">
                                                    <div class="input-group-text"><i class="tio-calendar-month"></i>
                                                    </div>
                                                </div>

                                                <input type="text" id="end1" name="end" data-input=""
                                                       class="flatpickr-custom-form-control form-control" required
                                                       placeholder="Hạn hoàn thành" value="{{ old('end') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group required">
                                            <label for="repeat1" class="input-label">Lặp lại</label>
                                            <select class="js-select2-custom custom-select" id="repeat1" name="repeat"
                                                    data-hs-select2-options='{"minimumResultsForSearch": "Infinity"}'>
                                                <option value="">Select Repeat</option>
                                                <option value="0">Never</option>
                                                <option value="1">Everyday</option>
                                                <option value="2">Weekdays</option>
                                                <option value="3">Monthly</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-5">
                                        <label for="attachment1" class="input-label">Tệp đính kèm
                                            <i class="tio-help-outlined text-body ml-1" data-toggle="tooltip"
                                               data-placement="top" title="Chỉ tải lên 1 tệp, nếu nhiều tệp thì nén lại
                                               rồi tải lên, các tệp được chấp nhận: image,.xlsx,.xls,.pdf,.doc,.docx">
                                            </i>
                                        </label>
                                        <div id="attachFiles1" class="js-dropzone dropzone-custom custom-file-boxed">
                                            <div class="dz-message custom-file-boxed-label">
                                                <img class="avatar avatar-xl avatar-4by3 mb-3" alt="Tệp đính kèm"
                                                     src="../assets/svg/illustrations/browse.svg">
                                                <h6>Drag and drop your file here</h6>
                                                <p class="mb-2">or</p>
                                                <span class="btn btn-sm btn-primary">Browse files</span>
                                            </div>
                                        </div>
                                        <div id="showAttachFiles"
                                             class="js-dropzone dropzone-custom custom-file-boxed"
                                             style="display: none"></div>
                                        <input type="hidden" class="upload1" id="attachment1" name="attachment">
                                    </div>

                                    <div class="col-sm-7">
                                        <div class="form-group">
                                            <label for="description1" class="input-label">Ghi chú</label>
                                            <textarea class="form-control" id="description1" name="description"
                                                      rows="12"
                                                      placeholder="Mô tả thông tin chi tiết"
                                                      value="{{ old('description') }}"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <div class="col-sm ">
                                    <a class="d-inline-flex align-items-center" id="created_id">
                                        <div class="avatar avatar-sm avatar-circle mr-2">
                                            <img class="avatar-img" id="created_avatar" alt="Avatar" src="">
                                        </div>
                                        <div class="media-body">
                                            <span class="h5 text-hover-primary" id="created_name"></span>
                                            <span class="ml-3 align-items-center" id="create_at"></span>
                                            <span class="ml-3 align-items-center" id="update_at"></span>
                                            <span class="media align-items-center" id="created_username"></span>
                                        </div>
                                    </a>
                                </div>

                                <button type="button" class="btn btn-white" data-dismiss="modal">Huỷ</button>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- End Update Task Modal --}}
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
    {{$dataTable->scripts()}}
    <script src="{{asset('/assets/js/action.js')}}"></script>
    <script src="{{asset('/assets/js/custom/members/task/task.js')}}"></script>
    @if (Agent::isMobile())
        @include('admin.layout.mobile')
    @endif
@endpush


