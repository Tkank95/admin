@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.add.headerPage', [
                     'breadcrumb_list' => 'role/list',
                     'breadcrumb' => 'Roles',
                     'page' => 'Add',
                     'pagetitle' => 'Thêm nhóm quyền mới',
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
                            @include('admin.layout.add.headerForm', ['headertitle' => 'Role Information'])
                            {{-- End Header --}}

                            <div class="card-body">
                                <div class="row">
                                    {{-- Form Group Name Role--}}
                                    <div class="col-sm-6">
                                        <div class="form-group required">
                                            <label for="name" class="input-label ">Name Role</label>
                                            <input type="text" class="form-control " name="name" id="name"
                                                   value="{{ old('name') }}" placeholder="Tên vai trò" required>
                                        </div>
                                    </div>
                                    {{-- End Form Group Name Role--}}

                                    {{-- Form Group Mô tả vai trò --}}
                                    <div class="col-sm-6">
                                        <div class="form-group required">
                                            <label for="link" class="input-label">Mô tả vai trò</label>
                                            <input type="text" class="form-control" name="display_name" required
                                                   id="display_name" value="{{ old('display_name') }}"
                                                   placeholder="Mô tả vai trò">
                                        </div>
                                    </div>
                                    {{-- End Form Group Mô tả vai trò --}}
                                </div>

                                <span class="divider"><h3>PERMISION OPTION</h3></span>

                                <div class="row-cols-sm-12">
                                    {{-- Checkbox Switch --}}
                                    <label class="toggle-switch d-flex align-items-center mb-3" for="checkall">
                                        <input type="checkbox" class="toggle-switch-input checkall" id="checkall">
                                        <span class="toggle-switch-label"><span class="toggle-switch-indicator"></span></span>
                                        <span class="toggle-switch-content">
                                            <span class="d-block">Check All</span></span>
                                    </label>
                                    {{-- End Checkbox Switch --}}

                                    @foreach($permisionParent as $permisionParentItem)
                                        <div class="accordion" id="accordion{{$permisionParentItem->id}}">
                                            <div class="card">
                                                <a class="card-header card-btn btn-block" href="javascript:"
                                                   data-toggle="collapse"
                                                   data-target="#collapse{{$permisionParentItem->id}}">Module {{$permisionParentItem->name}}
                                                    <span class="card-btn-toggle">
                                                    <span class="card-btn-toggle-default"><i class="tio-add"></i></span>
                                                    <span class="card-btn-toggle-active">
                                                        <i class="tio-remove"></i></span></span>
                                                </a>

                                                <div id="collapse{{$permisionParentItem->id}}" class="collapse"
                                                     data-parent="#accordion{{$permisionParentItem->id}}">
                                                    <div class="card-body form-check form-check-inline">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" id="all{{$permisionParentItem->id}}"
                                                                   class="custom-control-input checkbox_wrapper"
                                                                   value="">
                                                            <label class="custom-control-label"
                                                                   for="all{{$permisionParentItem->id}}">All</label>
                                                        </div>
                                                    </div>
                                                    @foreach($permisionParentItem->permissionChild as $permissionChildItem)
                                                        <div class="card-body form-check form-check-inline">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="permision_id[]"
                                                                       class="custom-control-input checkbox_childrent"
                                                                       id="{{$permissionChildItem->id}}"
                                                                       value="{{$permissionChildItem->id}}">
                                                                <label class="custom-control-label"
                                                                       for="{{$permissionChildItem->id}}">{{$permissionChildItem->name}}</label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Footer --}}
                            <div class="card-footer d-flex justify-content-end align-items-center">
                                <a class="btn btn-outline-primary mr-2" href="role/list">Cancel</a>
                                <button type="submit" class="btn btn-primary">Add Role</button>
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
    <script src="{{asset('/assets/js/custom/members/role.js')}}"></script>
@endsection
