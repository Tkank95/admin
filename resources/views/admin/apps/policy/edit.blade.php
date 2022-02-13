@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.add.headerPage', [
                         'breadcrumb_list' => 'policy/list',
                         'breadcrumb' => 'Policy',
                         'page' => 'Edit',
                         'pagetitle' => "Chỉnh sửa chính sách lương: {$policy->policyApp->name}",
                         'linklist' => 'policy/list',
                         'list' => 'List Policy'
                 ])
            {{-- End Page Header --}}

            @include('admin.layout.alert')

            <form id="policy" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3 mb-lg-5">
                            {{-- Header --}}
                            @include('admin.layout.add.headerForm', ['headertitle' => "Chi tiết chính sách: {$policy->policyApp->name}"])
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
                                                    <option
                                                        value="{{ $cate->id }}" {{$policy->cate_id == $cate->id ? 'selected' : ''}}>{{ $cate->name }}</option>
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
                                                    name="app_id" style="opacity: 0;" required
                                                    data-hs-select2-options='{"minimumResultsForSearch": "Infinity",
                                                                "placeholder": "Chọn thể loại để hiển thị"}'>
                                                <option value="{{$policy->app_id}}"
                                                        selected>{{$policy->policyApp->name}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- End Form Group Application --}}

                                    {{-- Form Group Ngày hiệu lực --}}
                                    <div class="col-sm-3">
                                        <div class="form-group required">
                                            <label for="active_day" class="input-label">Chính sách có hiệu lực từ
                                                ngày</label>
                                            <div class="js-flatpickr flatpickr-custom input-group input-group-merge"
                                                 id="dateActive" data-hs-flatpickr-options='{"appendTo": "#dateActive",
                                                 "dateFormat": "Y/m/d","wrap": true}'>
                                                <div class="input-group-prepend" data-toggle="">
                                                    <div class="input-group-text"><i class="tio-calendar-month"></i>
                                                    </div>
                                                </div>

                                                <input type="text" id="active_day" name="active_day" data-input=""
                                                       class="flatpickr-custom-form-control form-control" required
                                                       placeholder="Ngày hiệu lực của chính sách"
                                                       value="{{ $policy->active_day }}">
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Form Group Ngày hiệu lực --}}

                                    {{-- Form Group Status --}}
                                    <div class="col-sm-3">
                                        @include('admin.layout.edit.status', ['value' => 'policy'])
                                        {{-- End Form Group Status --}}
                                    </div>
                                </div>

                                <div class="row">
                                    {{-- Policy Idol --}}
                                    <div class="col-sm-6">
                                        <div class="form-group required">
                                            <label class="input-label">Chính sách lương Idol </label>
                                            <textarea name="policy_idol" id="policy_idol" class="form-control tinymce"
                                                      required rows="15"
                                                      placeholder="Nhập chi tiết chính sách lương Idol">
                                              {{ $policy->policy_idol }}</textarea>
                                        </div>
                                    </div>
                                    {{-- End Policy Idol --}}

                                    {{-- Policy Agency --}}
                                    <div class="col-sm-6">
                                        <div class="form-group required">
                                            <label class="input-label required">Chính sách lương Agency </label>
                                            <textarea name="policy_agency" id="policy_agency" rows="15" required
                                                      class="form-control tinymce"
                                                      placeholder="Nhập chi tiết chính sách lương Agency">
                                                {{ $policy->policy_agency }}</textarea>
                                        </div>
                                    </div>
                                    {{-- End Policy Agency --}}
                                </div>
                            </div>

                            {{-- Footer --}}
                            <div class="card-footer d-flex justify-content-end align-items-center">
                                <a class="btn btn-outline-primary mr-2" href="policy/list">Huỷ</a>
                                <button type="submit" class="btn btn-primary">Cập nhật</button>
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
    <script src="{{asset('/assets/js/custom/apps/policy/policy.js')}}"></script>
@endsection
