@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.add.headerPage', [
                         'breadcrumb_list' => 'app/list',
                         'breadcrumb' => 'Apps',
                         'page' => 'Edit',
                         'pagetitle' => "Chỉnh sửa ứng dụng live: $application->name",
                         'linklist' => 'app/list',
                         'list' => 'List Applications'
                 ])
            {{-- End Page Header --}}

            @include('admin.layout.alert')

            <form id="application" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3 mb-lg-5">
                            {{-- Header --}}
                            @include('admin.layout.add.headerForm', ['headertitle' => "Chi tiết ứng dụng $application->name"])
                            {{-- End Header --}}

                            <div class="card-body">
                                <div class="col-lg-12">
                                    <div class="row">
                                        {{-- Form Group Name Application--}}
                                        <div class="col-sm-2">
                                            <div class="form-group required">
                                                <label for="name" class="input-label">Name Application</label>
                                                <input type="text" class="form-control" id="name" name="name" required
                                                       value="{{ $application->name }}"
                                                       placeholder="Tên ứng dụng livestream">
                                            </div>
                                        </div>
                                        {{-- End Form Group Name Application--}}

                                        {{-- Form Group Category --}}
                                        <div class="col-sm-2">
                                            <div class="form-group required">
                                                <label for="cate_id" class="input-label">Category</label>
                                                <select class="js-select2-custom custom-select" id="cate_id"
                                                        name="cate_id"
                                                        size="1" style="opacity: 0;" required
                                                        data-hs-select2-options='{"minimumResultsForSearch": "Infinity",
                                                          "placeholder": "Chọn thể loại ứng dụng"}'>
                                                    <option value=""></option>
                                                    <option value="0">Danh mục gốc</option>
                                                    @foreach($menus as $cate)
                                                        <option value="{{ $cate->id }}" {{ $application->cate_id == $cate->id ? 'selected' : ''  }}>{{ $cate->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        {{-- End Form Group Category --}}

                                        {{-- Link_download --}}
                                        <div class="col-sm-2">
                                            <div class="form-group required">
                                                <label class="input-label required">Link tải ứng dụng</label>
                                                <input type="text" name="link_download" id="link_download" required
                                                       class="form-control" placeholder="Nhập link tải ứng dụng"
                                                       value="{{ $application->link_download }}">
                                            </div>
                                        </div>
                                        {{-- End Link_download --}}

                                        {{-- Form Group Status --}}
                                        <div class="col-sm-3">
                                            @include('admin.layout.edit.status', ['value' => 'application'])
                                        </div>
                                        {{-- End Form Group Status --}}

                                        {{-- Form Group Top --}}
                                        <div class="col-sm-3">
                                            @include('admin.layout.edit.top', ['model' => 'Application', 'value' => 'application'])
                                        </div>
                                        {{-- End Form Group Top --}}
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    {{-- Logo Application --}}
                                    @include('admin.layout.edit.image', [
                                            'name_img' => 'logo',
                                            'class' => 'logo',
                                            'label' => 'Logo Application',
                                            'tooltip' => 'Ảnh có kích thước 400x400',
                                            'value' => 'application'
                                        ])
                                    {{-- End Logo Application --}}
                                </div>
                            </div>

                            {{-- Footer --}}
                            <div class="card-footer d-flex justify-content-end align-items-center">
                                <a class="btn btn-outline-primary mr-2" href="app/list">Huỷ</a>
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
    <script src="{{asset('/assets/js/custom/apps/app/application.js')}}"></script>
@endsection
