@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.add.headerPage', [
                     'breadcrumb_list' => 'rule/list',
                     'breadcrumb' => 'Live Rule',
                     'page' => 'Add',
                     'pagetitle' => 'Thêm quy định live mới',
                     'linklist' => 'rule/list',
                     'list' => 'List Rule'
                 ])
            {{-- End Page Header --}}

            @include('admin.layout.alert')

            <form id="ruleLive" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3 mb-lg-5">
                            {{-- Header --}}
                            @include('admin.layout.add.headerForm', ['headertitle' => "Chi tiết quy định"])
                            {{-- End Header --}}

                            <div class="card-body">
                                <div class="row">
                                    {{-- Form Group Category --}}
                                    <div class="col-sm-3">
                                        <div class="form-group required">
                                            <label for="cate" class="input-label">Thể loại</label>
                                            <select class="js-select2-custom custom-select" id="cate" size="1"
                                                    name="cate_id" style="opacity: 0;" required
                                                    data-hs-select2-options='{"minimumResultsForSearch": "Infinity",
                                                                "placeholder": "Chọn thể loại"}'>
                                                <option value=""></option>
                                                @foreach($menus as $cate)
                                                    <option value="{{ $cate->id }}">{{ $cate->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- End Form Group Category --}}

                                    {{-- Form Group Application --}}
                                    <div class="col-sm-3">
                                        <div class="form-group required">
                                            <label for="app_id" class="input-label">Ứng dụng</label>
                                            <select class="js-select2-custom custom-select" id="app_id" size="1"
                                                    name="app_id" style="opacity: 0;" disabled required
                                                    data-hs-select2-options='{"minimumResultsForSearch": "Infinity",
                                                                "placeholder": "Chọn thể loại để hiển thị"}'>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- End Form Group Application --}}

                                    {{-- Form Group Ngày hiệu lực --}}
                                    <div class="col-sm-3">
                                        <div class="form-group required">
                                            <label for="active_day" class="input-label">Quy định có hiệu lực từ
                                                ngày</label>
                                            <div class="js-flatpickr flatpickr-custom input-group input-group-merge"
                                                 id="dateActive" data-hs-flatpickr-options='{"appendTo": "#dateActive",
                                                                     "dateFormat": "Y/m/d","wrap": true}'>
                                                <div class="input-group-prepend" data-toggle="">
                                                    <div class="input-group-text">
                                                        <i class="tio-calendar-month"></i>
                                                    </div>
                                                </div>

                                                <input type="text" id="active_day" name="active_day" data-input=""
                                                       class="flatpickr-custom-form-control form-control" required
                                                       placeholder="Ngày hiệu lực của chính sách"
                                                       value="{{ old('active_day') }}">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Form Group Ngày hiệu lực --}}

                                    {{-- Form Group Status --}}
                                    <div class="col-sm-3">
                                        @include('admin.layout.add.status')
                                        {{-- End Form Group Status --}}
                                    </div>
                                </div>

                                <div>
                                    {{-- Quy định live --}}
                                    <div class="form-group required">
                                        <label class="input-label">Quy định live </label>
                                        <textarea name="live_rule" id="live_rule" class="form-control tinymce"
                                                  required rows="15" placeholder="Nhập chi tiết Quy định live">
                                              {{ old('policy_idol') }}</textarea>
                                    </div>
                                    {{-- End Quy định live --}}
                                </div>
                            </div>

                            {{-- Footer --}}
                            <div class="card-footer d-flex justify-content-end align-items-center">
                                <a class="btn btn-outline-primary mr-2" href="rule/list">Huỷ</a>
                                <button type="submit" class="btn btn-primary">Lưu</button>
                            </div>
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
    <script src="{{asset('/assets/js/custom/apps/live_rule/rule.js')}}"></script>
@endsection
