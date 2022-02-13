@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.add.headerPage', [
                         'breadcrumb_list' => 'slide/list',
                         'breadcrumb' => 'Slides',
                         'page' => 'Edit',
                         'pagetitle' => "Chỉnh sửa slide: $slide->name",
                         'linklist' => 'slide/list',
                         'list' => 'List Slides'
                 ])
            {{-- End Page Header --}}

            @include('admin.layout.alert')

            <form id="slide" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3 mb-lg-5">
                            {{-- Header --}}
                            @include('admin.layout.edit.headerForm', ['headertitle' => "Slide $slide->name Information"])
                            {{-- End Header --}}

                            <div class="card-body">
                                <div class="row">
                                    {{-- Form Group Name --}}
                                    <div class="col-sm-5">
                                        <div class="form-group required">
                                            <label for="name" class="input-label">Name Slide</label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                   value="{{$slide->name}}" placeholder="Tên slide" required>
                                        </div>
                                    </div>
                                    {{-- End Form Group Name --}}

                                    {{-- Form Group Link Url --}}
                                    <div class="col-sm-4">
                                        <div class="form-group required">
                                            <label for="link" class="input-label">Link Url</label>
                                            <input type="text" class="form-control" name="link" id="link"
                                                   value="{{$slide->link}}" placeholder="Đường link liên kết" required>
                                        </div>
                                    </div>
                                    {{-- End Form Group Link Url --}}

                                    {{-- Form Group Status--}}
                                    <div class="col-sm-3">
                                        @include('admin.layout.edit.status', ['value' => 'slide'])
                                    </div>
                                    {{-- End Form Group Status --}}
                                </div>

                                <div class="row">
                                    {{-- Form Group Content --}}
                                    <div class="col-sm-6">
                                        <div class="form-group required">
                                            <label class="input-label">Content</label>
                                            <textarea name="content" id="content_slide" class="form-control tinymce"
                                                      rows="10" required>{{$slide->content}}</textarea>
                                        </div>
                                    </div>
                                    {{-- End Form Group Content --}}

                                    {{-- Form Group Description --}}
                                    <div class="col-sm-6">
                                        <div class="form-group required">
                                            <label class="input-label">Description</label>
                                            <textarea id="description_slide" class="form-control tinymce" required
                                                      rows="10" name="description">{{$slide->description}}</textarea>
                                        </div>
                                    </div>
                                    {{-- End Form Group Description --}}
                                </div>

                                {{-- Image Slide --}}
                                @include('admin.layout.edit.image', [
                                        'name_img' => 'image',
                                        'class' => 'image',
                                        'label' => 'Ảnh slide',
                                        'tooltip' => 'Ảnh có kích thước 1360 x 540 pixel',
                                        'value' => 'slide'
                                    ])
                                {{-- End Image Slide --}}
                            </div>
                        </div>

                        {{-- Footer --}}
                        <div class="card-footer d-flex justify-content-end align-items-center">
                            <a class="btn btn-outline-primary mr-2" href="slide/list">Cancel</a>
                            <button type="submit" class="btn btn-primary">Update Slide</button>
                        </div>
                        {{-- End Footer --}}
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{asset('/assets/js/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('/assets/js/custom/news/slide/slide.js')}}"></script>
@endsection

