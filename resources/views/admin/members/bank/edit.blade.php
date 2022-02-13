@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.add.headerPage', [
                         'breadcrumb_list' => 'bank/list',
                         'breadcrumb' => 'Bank',
                         'page' => 'Edit',
                         'pagetitle' => "Chỉnh sửa Bank User: {$banks->bankUser->email}",
                         'linklist' => 'bank/list',
                         'list' => 'List Bank'
                 ])
            {{-- End Page Header --}}

            @include('admin.layout.alert')

            <form id="role" action="" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3 mb-lg-5">
                            {{-- Header --}}
                            @include('admin.layout.add.headerForm', ['headertitle' => "Bank Information User: {$banks->bankUser->name}"])
                            {{-- End Header --}}

                            <div class="card-body">
                                <div class="row">
                                    {{-- Form Group Email --}}
                                    <div class="col-sm-6">
                                        <div class="form-group required">
                                            <label for="user_id" class="input-label ">Email</label>
                                            <select class="js-select2-custom custom-select" size="1" style="opacity: 0;"
                                                    name="user_id" id="user_id" data-hs-select2-options='{
                                                      "placeholder": "Chọn email tìm kiếm user",
                                                      "searchInputPlaceholder": "Nhập email"}'>
                                                <option value=""></option>
                                                @foreach($user as $email)
                                                    <option
                                                        value="{{$email->id}}" {{ $banks->user_id == $email->id ? ' selected=""' : '' }}>{{$email->email}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- End Form Group Email --}}

                                    {{-- Form Group Họ và tên --}}
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="fullname" class="input-label ">Họ và tên</label>
                                            <input type="text" class="form-control" name="fullname" id="fullname"
                                                   value="{{optional($banks->bankUser)->name}}"
                                                   placeholder="Chọn email để hiển thị" disabled>
                                        </div>
                                    </div>
                                    {{-- End Form Group Họ và tên --}}
                                </div>

                                <div class="row">
                                    {{-- Form Group Username --}}
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="username" class="input-label ">Username</label>
                                            <input type="text" class="form-control" name="username" id="username"
                                                   value="{{optional($banks->bankUser)->username}}"
                                                   placeholder="Chọn email để hiển thị" disabled>
                                        </div>
                                    </div>
                                    {{-- End Form Group Username --}}

                                    {{-- Form Group Position --}}
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="position" class="input-label ">Position</label>
                                            <input type="text" class="form-control" name="position" id="position"
                                                   value="{!! \App\Helpers\Helper::position(optional($banks->bankUser)->position) !!}"
                                                   placeholder="Chọn email để hiển thị" disabled>
                                        </div>
                                    </div>
                                    {{-- End Form Group Position --}}
                                </div>

                                <div class="row">
                                    {{-- Form Group Tên chủ tài khoản --}}
                                    <div class="col-sm-6">
                                        <div class="form-group required">
                                            <label for="name" class="input-label ">Tên chủ tài khoản</label>
                                            <input type="text" class="form-control " name="name" id="name"
                                                   value="{{ $banks->name }}" placeholder="Tên chủ tài khoản" required>
                                        </div>
                                    </div>
                                    {{-- End Form Group Tên chủ tài khoản --}}

                                    {{-- Form Group Số tài khoản --}}
                                    <div class="col-sm-6">
                                        <div class="form-group required">
                                            <label for="account" class="input-label">Số tài khoản</label>
                                            <input type="number" class="form-control" name="account" id="account" required
                                                   value="{{ $banks->account }}" placeholder="Số tài khoản ngân hàng">
                                        </div>
                                    </div>
                                    {{-- End Form Group Số tài khoản --}}
                                </div>

                                <div class="row">
                                    {{-- End Form Group Tên ngân hàng --}}
                                    <div class="col-sm-6">
                                        <div class="form-group required">
                                            <label for="bank_name" class="input-label ">Tên ngân hàng</label>
                                            <select class="js-select2-custom custom-select" size="1" style="opacity: 0;"
                                                    name="bank_name" id="bank_name" data-hs-select2-options='{
                                                      "placeholder": "Chọn tên ngân hàng",
                                                      "searchInputPlaceholder": "Search a bank name"}'>
                                                <option value=""></option>
                                                @foreach(config('bank.bank_name') as $moduleItem)
                                                    <option
                                                        value="{{$moduleItem}}" {{ $banks->bank_name == $moduleItem ? ' selected=""' : '' }}>{{$moduleItem}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- End Form Group Tên ngân hàng --}}

                                    {{-- Form Group Chi nhánh ngân hàng--}}
                                    <div class="col-sm-6">
                                        <div class="form-group required">
                                            <label for="branch" class="input-label ">Chi nhánh ngân hàng</label>
                                            <select class="js-select2-custom custom-select" size="1" style="opacity: 0;"
                                                    name="branch" id="branch" data-hs-select2-options='{
                                                      "placeholder": "Chọn chi nhánh ngân hàng",
                                                      "searchInputPlaceholder": "Search a branch"}'>
                                                <option value=""></option>
                                                @foreach(config('bank.branch') as $moduleItem)
                                                    <option
                                                        value="{{$moduleItem}}" {{ $banks->branch == $moduleItem ? ' selected=""' : '' }}>{{$moduleItem}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    {{-- End Form Group Chi nhánh ngân hàng--}}
                                </div>
                            </div>

                            {{-- Footer --}}
                            <div class="card-footer d-flex justify-content-end align-items-center">
                                <a class="btn btn-outline-primary mr-2" href="bank/list">Cancel</a>
                                <button type="submit" class="btn btn-primary">Update Bank User</button>
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
    <script src="{{asset('/assets/js/custom/members/bank/bank.js')}}"></script>
@endsection
