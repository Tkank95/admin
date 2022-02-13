@extends('admin.layout.index')
@section('content')
    <div id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-no-gutter">
                                <li class="breadcrumb-item">
                                    <a class="breadcrumb-link" href="feedback/list">Feedback</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">List</li>
                            </ol>
                        </nav>
                        <h1 class="page-header-title">Hòm thư góp ý</h1>
                    </div>
                </div>
            </div>
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
                                            'headertitle' => 'List Feedback',
                                            'searchholder' => 'nội dung góp ý hoặc nội dung trả lời'
                                    ])

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
                                                    <h5 class="card-header-title">Filter Feedback</h5>

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
                                                                <select class="js-select2-custom custom-select" size="1"
                                                                        style="opacity: 0;" name="filter1" id="filter1"
                                                                        data-hs-select2-options='{"searchInputPlaceholder": "Tìm kiếm username"}'>
                                                                    <option value="">All username</option>
                                                                    @foreach($users as $user)
                                                                        <option
                                                                            value="{{$user->id}}">{{$user->username}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Số điện thoại</small>
                                                                <input type="number" class="form-control" name="filter2"
                                                                       id="filter2" value="{{ old('filter2') }}"
                                                                       placeholder="Nhập số điện thoại">
                                                            </div>
                                                        </div>

                                                        <div class="form-row">
                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Start Date</small>
                                                                <div
                                                                    class="js-flatpickr flatpickr-custom input-group input-group-merge"
                                                                    id="dateStart" data-hs-flatpickr-options='{"appendTo": "#dateStart",
                                                                     "dateFormat": "Y-m-d","wrap": true}'>
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
                                                                    "dateFormat": "Y-m-d","wrap": true}'>
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
                                                                <small class="text-cap mb-2">Email</small>
                                                                <input type="email" class="form-control" name="filter3"
                                                                       id="filter3" value="{{ old('filter3') }}"
                                                                       placeholder="vidu@gmail.com">
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
                                                    @include('admin.layout.list.column.column', [
                                                                'col2' => 'Username',
                                                                'col3' => 'Họ và tên',
                                                                'col4' => 'Số điện thoại',
                                                                'col5' => 'Email',
                                                                'col6' => 'Nội dung',
                                                                'col7' => 'Trả lời',
                                                                'col8' => 'Created_at',
                                                                'col9' => 'Updated_at',
                                                                'col10' => 'Action'
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

                {{-- Reply Feedback --}}
                <div class="modal fade" id="editFeedbackModal" aria-hidden="true">
                    <div class="modal-dialog modal-xl modal-dialog-centered">
                        <div class="modal-content">
                            <form id="editFeedback" name="editFeedback" class="form-horizontal">
                                @csrf
                                <input type="hidden" name="id" id="id">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="modalHeading"></h4>
                                    <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary"
                                            data-dismiss="modal"
                                            aria-label="Close"><i class="tio-clear tio-lg"></i></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group required">
                                        <label for="content" class="input-label">Nội dung phản hồi, góp ý</label>
                                        <textarea id="content_feedback" name="content" class="form-control" rows="10"
                                                  disabled>
                                        </textarea>
                                    </div>
                                    <div class="form-group required">
                                        <label for="result" class="input-label">Trả lời </label>
                                        <textarea id="result" name="result" class="form-control" rows="10" required
                                                  placeholder="Nhập nội dung trả lời"></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Lưu</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- End Reply Feedback Modal --}}
            </form>
        </div>
    </div>
@endsection

@push('scripts')

    <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
    {{$dataTable->scripts()}}
    <script src="{{asset('/assets/js/action.js')}}"></script>
    <script src="{{asset('/assets/js/custom/members/feedback/feedback.js')}}"></script>
    @if (Agent::isMobile())
        @include('admin.layout.mobile')
    @endif
@endpush


