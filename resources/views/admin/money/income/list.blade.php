@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.list.headerPageAjax', [
                        'breadcrumb_list' => 'income/list',
                        'breadcrumb' => 'Income',
                        'page' => 'List',
                        'pagetitle' => 'Danh sách thu nhập',
                        'target' => 'incomeModal',
                        'action_title' => 'Add Income'
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

                                    @include('admin.layout.list.headerForm', ['headertitle' => 'List Income','searchholder' => 'tên loại thu nhập'])

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
                                                    <h5 class="card-header-title">Filter Income</h5>

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
                                                                <small class="text-cap mb-2">Tiền thu nhập</small>
                                                                <input type="text" id="filter2" name="filter2"
                                                                       class="form-control convert-number"
                                                                       placeholder="Số tiền" value="{{old('filter2')}}">
                                                            </div>

                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Đến số tiền</small>
                                                                <input type="text" id="filter3" name="filter3"
                                                                       class="form-control convert-number"
                                                                       placeholder="Đến khoảng"
                                                                       value="{{old('filter3')}}">
                                                            </div>

                                                            <div class="col-sm form-group col-sm-3">
                                                                <small class="text-cap mb-2">Đơn vị</small>
                                                                <select
                                                                    class="js-select2-custom js-datatable-filter custom-select"
                                                                    size="1" style="opacity: 0;" id="unit" name="unit"
                                                                    data-hs-select2-options='{"minimumResultsForSearch": "Infinity"}'>
                                                                    <option value="vnd" selected>VNĐ</option>
                                                                    <option value="usd">USD</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        @include('admin.layout.list.filter.filterDate')

                                                        <div class="form-row">
                                                            <div class="col-sm form-group">
                                                                <small class="text-cap mb-2">Thời gian nhận thu
                                                                    nhập</small>
                                                                <div
                                                                    class="js-flatpickr flatpickr-custom input-group input-group-merge"
                                                                    id="dateIncome" data-hs-flatpickr-options='{"appendTo": "#dateIncome",
                                                                     "dateFormat": "Y-m-d","wrap": true}'>
                                                                    <div class="input-group-prepend" data-toggle="">
                                                                        <div class="input-group-text">
                                                                            <i class="tio-calendar-month"></i>
                                                                        </div>
                                                                    </div>

                                                                    <input type="text" id="filter1" name="filter1"
                                                                           class="flatpickr-custom-form-control form-control"
                                                                           placeholder="Ngày nhận thu nhập"
                                                                           data-input="" value="{{old('filter1')}}">
                                                                </div>
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
                                                                     'col2' => 'Thời gian nhận thu nhập',
                                                                     'col3' => 'Loại thu nhập',
                                                                     'col4' => 'Số tiền (vnđ)',
                                                                     'col5' => 'Số tiền (usd)',
                                                                     'col6' => 'Tỉ giá (usd)',
                                                                     'col7' => 'Ghi chú',
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

            {{-- Add Income Modal --}}
            <div class="modal fade" id="incomeModal" data-backdrop="static" tabindex="-1" role="dialog"
                 aria-labelledby="incomeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form id="addIncome">@csrf
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalHeading">Create a new income</h4>
                                <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary"
                                        data-dismiss="modal" aria-label="Close">
                                    <i class="tio-clear tio-lg"></i></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group required">
                                            <label for="received_date" class="input-label">Thời gian nhận thu
                                                nhập</label>
                                            <div class="js-flatpickr flatpickr-custom input-group input-group-merge"
                                                 id="dateReceived" data-hs-flatpickr-options='{"appendTo": "#dateReceived",
                                             "dateFormat": "Y-m-d H:i:ss","wrap": true, "enableTime": true, "time_24hr": true}'>
                                                <div class="input-group-prepend" data-toggle="">
                                                    <div class="input-group-text"><i class="tio-calendar-month"></i>
                                                    </div>
                                                </div>

                                                <input type="text" id="received_date" name="received_date" data-input=""
                                                       class="flatpickr-custom-form-control form-control" required
                                                       placeholder="Ngày giờ nhận thu nhập"
                                                       value="{{ old('received_date') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group required">
                                            <label for="income_cate" class="input-label">Loại thu nhập</label>
                                            <select size="1" style="opacity: 0;" id="income_cate" name="income_cate"
                                                    class="js-select2-custom custom-select" required
                                                    data-hs-select2-options='{"searchInputPlaceholder": "Tìm kiếm loại thu nhập",
                                                "placeholder": "Chọn loại thu nhập"}'>
                                                <option value=""></option>
                                                @foreach($category as $cate)
                                                    <option value="{{$cate->id}}">{{$cate->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group required">
                                            <label for="amount_vnd" class="input-label">Số tiền VNĐ</label>
                                            <input type="text" class="form-control convert-number" id="amount_vnd"
                                                   name="amount_vnd" required placeholder="Nhập số tiền vnđ"
                                                   value="{{ old('amount_vnđ') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="amount_usd" class="input-label">Số tiền USD (nếu có)</label>
                                            <input type="number" class="form-control" id="amount_usd" name="amount_usd"
                                                   placeholder="Nhập số tiền usd nếu có" step=".01"
                                                   value="0">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="rate" class="input-label">Tỉ giá USD (nếu có)</label>
                                            <input type="text" class="form-control convert-number" id="rate" name="rate"
                                                   placeholder="Tỉ giá quy đổi usd sang vnđ" value="0">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="description" class="input-label">Ghi chú</label>
                                            <textarea class="form-control" id="description" name="description" rows="5"
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
            {{-- End Add Income Modal --}}

            {{-- Update Income Modal --}}
            <div class="modal fade" id="editIncomeModal" data-backdrop="static" tabindex="-1" role="dialog"
                 aria-labelledby="editIncomeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <form id="editIncome">@csrf
                            <div class="modal-header">
                                <h4 class="modal-title" id="modalHeading">Cập nhật thu nhập</h4>
                                <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary"
                                        data-dismiss="modal" aria-label="Close"><i class="tio-clear tio-lg"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group required">
                                            <label for="received_date" class="input-label">Thời gian nhận thu nhập</label>
                                            <div class="js-flatpickr flatpickr-custom input-group input-group-merge"
                                                 id="dateReceived1" data-hs-flatpickr-options='{"appendTo": "#dateReceived1",
                                             "dateFormat": "Y-m-d H:i:ss", "wrap": true, "enableTime": true, "time_24hr": true}'>
                                                <div class="input-group-prepend" data-toggle="">
                                                    <div class="input-group-text"><i class="tio-calendar-month"></i>
                                                    </div>
                                                </div>

                                                <input type="text" id="received_date1" name="received_date" data-input=""
                                                       class="flatpickr-custom-form-control form-control" required
                                                       placeholder="Ngày giờ nhận thu nhập"
                                                       value="{{ old('received_date') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-8">
                                        <div class="form-group required">
                                            <label for="income_cate" class="input-label">Loại thu nhập</label>
                                            <select size="1" style="opacity: 0;" id="income_cate1" name="income_cate"
                                                    class="js-select2-custom custom-select" required
                                                    data-hs-select2-options='{"searchInputPlaceholder": "Tìm kiếm loại thu nhập",
                                                "placeholder": "Chọn loại thu nhập"}'>
                                                <option value=""></option>
                                                @foreach($category as $cate)
                                                    <option value="{{$cate->id}}">{{$cate->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group required">
                                            <label for="amount_vnd" class="input-label">Số tiền VNĐ</label>
                                            <input type="text" class="form-control convert-number" id="amount_vnd1"
                                                   name="amount_vnd" required placeholder="Nhập số tiền vnđ"
                                                   value="{{ old('amount_vnđ') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="amount_usd" class="input-label">Số tiền USD (nếu có)</label>
                                            <input type="number" class="form-control" id="amount_usd1" name="amount_usd"
                                                   placeholder="Nhập số tiền usd nếu có" step=".01"
                                                   value="{{ old('amount_usd') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label for="rate" class="input-label">Tỉ giá USD (nếu có)</label>
                                            <input type="text" class="form-control convert-number" id="rate1"
                                                   name="rate"
                                                   placeholder="Tỉ giá quy đổi usd sang vnđ" value="{{ old('rate') }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="description" class="input-label">Ghi chú</label>
                                            <textarea class="form-control" id="description1" name="description" rows="5"
                                                      placeholder="Mô tả thông tin chi tiết"
                                                      value="{{ old('description') }}"></textarea>
                                        </div>
                                    </div>
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
            {{-- End Update Income Modal --}}
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{asset('vendor/datatables/buttons.server-side.js')}}"></script>
    {{$dataTable->scripts()}}
    <script src="{{asset('/assets/js/action.js')}}"></script>
    <script src="{{asset('/assets/js/custom/money/income/income.js')}}"></script>
    @if (Agent::isMobile())
        @include('admin.layout.mobile')
    @endif
@endpush


