@extends('admin.layout.index')

@section('head')
    <link rel="stylesheet" href="{{asset('/assets/css/custom/application.css')}}">
@endsection

@section('content')

    {{-- Content --}}
    <div id="content" role="main" class="main">
        {{-- Content --}}
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.list.headerPage', [
                         'breadcrumb_list' => 'app/list',
                         'breadcrumb' => 'Apps',
                         'page' => 'List',
                         'pagetitle' => 'Danh sách ứng dụng live streams',
                         'linkadd' => 'app/add',
                         'add' => 'Add New Application'
                     ])
            {{-- End Page Header --}}

            @include('admin.layout.alert')

            <form method="post">
                @csrf
                <div class="row ">
                    <div class="col-lg-12">
                        {{-- Card --}}
                        <div class="card mb-3 mb-lg-5">
                            {{-- Header --}}
                            <div class="card-header">
                                <div class="row justify-content-between align-items-center flex-grow-1">
                                    <div class="col-sm mb-3 mb-sm-0">
                                        <h4 class="card-header-title">List Recycle Users</h4>
                                    </div>

                                    {{-- Seach --}}
                                    <div class="col-sm-6 col-md-4 mb-3 mb-sm-0">
                                        <form>
                                            {{-- Search --}}
                                            <div class="input-group input-group-merge input-group-flush">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">
                                                        <i class="tio-search"></i>
                                                    </div>
                                                </div>
                                                <input id="datatableSearch" type="search" class="form-control"
                                                       placeholder="Search application" aria-label="Search application">
                                            </div>
                                            {{-- End Search --}}
                                        </form>
                                    </div>
                                    {{-- End Seach --}}

                                    {{-- Delete All Info --}}
                                    <div class="col-sm-auto mb-3 mb-sm-0">
                                        <div id="datatableCounterInfo" style="display: none;">
                                            <div class="d-flex align-items-center">
                                                <span class="font-size-sm mr-3">
                                                  <span id="datatableCounter">0</span>
                                                  Selected
                                                </span>
                                                <a class="btn btn-sm btn-outline-danger deleteAll" href="javascript:;">
                                                    <i class="tio-delete-outlined"></i> Delete
                                                </a>

                                                <a class="btn btn-sm btn-outline-danger deleteAll" href="javascript:;">
                                                    <i class="tio-delete-outlined"></i> Restore
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Delete All Info --}}
                                </div>
                                {{-- End Row --}}
                            </div>
                            {{-- End Header --}}

                            {{-- Table --}}
                            <div class="table-responsive datatable-custom">
                                <table id="datatable"
                                       class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                                    <thead class="thead-light ">
                                    <tr>
                                        <th scope="col" class="table-column-pr-0 ">
                                            <div class="custom-control custom-checkbox">
                                                <input id="datatableCheckAll" type="checkbox"
                                                       class="custom-control-input">
                                                <label class="custom-control-label" for="datatableCheckAll"></label>
                                            </div>
                                        </th>
                                        <th>Information</th>
                                        <th>Username</th>
                                        <th>Info</th>
                                        <th>Bank</th>
                                        <th>Apply Job</th>
                                        <th>News Tutorial</th>
                                        <th>Comments</th>
                                        <th>Created_at</th>
                                        <th>Deleted_at</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                </table>
                            </div>
                            {{-- End Table --}}

                            {{-- Footer --}}
                            @include('admin.layout.list.tableFooter')
                            {{-- End Footer --}}
                        </div>
                        {{-- End Card --}}
                    </div>
                    {{-- End Card --}}
                </div>

            </form>
            {{-- End Row --}}
        </div>
        {{-- End Content --}}
    </div>
@endsection

@section('js')
    <script src="{{asset('/assets/js/action.js')}}"></script>
    <script src="{{asset('/assets/js/custom/user/user_trashed.js')}}"></script>
@endsection

