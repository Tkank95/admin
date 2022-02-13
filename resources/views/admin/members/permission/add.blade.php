@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.add.headerPage', [
                     'breadcrumb_list' => 'role/list',
                     'breadcrumb' => 'Roles',
                     'page' => 'Add',
                     'pagetitle' => 'Thêm quyền mới',
                     'linklist' => 'role/list',
                     'list' => 'List Roles'
                 ])
            {{-- End Page Header --}}

            @include('admin.layout.alert')

            <form id="role" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3 mb-lg-5">
                            {{-- Header --}}
                            @include('admin.layout.add.headerForm', ['headertitle' => 'Permission Information'])
                            {{-- End Header --}}

                            <div class="card-body">
                                <div class="form-group required">
                                    <label for="module_parent" class="input-label">Phân quyền chức năng</label>
                                    <select class="custom-select" id="module_parent" name="module_parent" required>
                                        <option value="">Chọn module</option>
                                        @foreach(config('permissions.table_module') as $moduleItem)
                                            <option value="{{$moduleItem}}">{{$moduleItem}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <span class="divider "><h3>PERMISION OPTION</h3></span>

                                <div class="row-cols-sm-12">
                                    <div class="card-body form-check form-check-inline">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input checkbox_wrapper"
                                                   id="all" value="">
                                            <label class="custom-control-label" for="all">All</label>
                                        </div>
                                    </div>
                                    @foreach(config('permissions.module_childrent') as $moduleItemChildrent)
                                        <div class="card-body form-check form-check-inline col-sm-2">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="module_childrent[]"
                                                       class="custom-control-input checkbox_childrent"
                                                       id="{{$moduleItemChildrent}}" value="{{$moduleItemChildrent}}">
                                                <label class="custom-control-label" for="{{$moduleItemChildrent}}">
                                                    {{$moduleItemChildrent}}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Footer --}}
                            <div class="card-footer d-flex justify-content-end align-items-center">
                                <a class="btn btn-outline-primary mr-2" href="role/list">Cancel</a>
                                <button type="submit" class="btn btn-primary">Add Permission</button>
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
    <script src="{{asset('/assets/js/custom/members/permission.js')}}"></script>
@endsection
