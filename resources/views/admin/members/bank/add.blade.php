@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.add.headerPage', [
                     'breadcrumb_list' => 'bank/list',
                     'breadcrumb' => 'Banks',
                     'page' => 'Add',
                     'pagetitle' => 'Thêm thông tin ngân hàng mới',
                     'linklist' => 'bank/list',
                     'list' => 'List Bank Users'
                 ])
            {{-- End Page Header --}}

            @include('admin.layout.alert')

            <form id="bank" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3 mb-lg-5">
                            {{-- Header --}}
                            @include('admin.layout.add.headerForm', ['headertitle' => "Bank Information"])
                            {{-- End Header --}}

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group required">
                                            <label for="user_id" class="input-label ">Email </label>
                                            <select class="js-select2-custom custom-select" size="1" style="opacity: 0;"
                                                    name="user_id" id="user_id" required data-hs-select2-options='{
                                                          "placeholder": "Chọn email tìm kiếm user",
                                                          "searchInputPlaceholder": "Nhập email"}'>
                                                <option value=""></option>
                                                @foreach($user as $email)
                                                    <option value="{{$email->id}}">{{$email->email}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="fullname" class="input-label ">Họ và tên </label>
                                            <input type="text" class="form-control" name="fullname" id="fullname"
                                                   placeholder="Chọn email để hiển thị" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="username" class="input-label ">Username </label>
                                            <input type="text" class="form-control" name="username" id="username"
                                                   placeholder="Chọn email để hiển thị" disabled>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="position" class="input-label ">Position </label>
                                            <input type="text" class="form-control" name="position" id="position"
                                                   placeholder="Chọn email để hiển thị" disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group required">
                                            <label for="name" class="input-label ">Tên chủ tài khoản </label>
                                            <input type="text" class="form-control " name="name" id="name" required
                                                   value="{{ old('name') }}" placeholder="Tên chủ tài khoản">
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group required">
                                            <label for="account" class="input-label">Số tài khoản </label>
                                            <input type="number" class="form-control" value="{{old('account')}}" required
                                                   name="account" id="account" placeholder="Số tài khoản ngân hàng">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group required">
                                            <label for="bank_name" class="input-label ">Tên ngân hàng </label>
                                            <select class="js-select2-custom custom-select" size="1" style="opacity: 0;"
                                                    name="bank_name" id="bank_name" required data-hs-select2-options='{
                                                          "placeholder": "Chọn tên ngân hàng",
                                                          "searchInputPlaceholder": "Search a bank name"}'>
                                                <option value=""></option>
                                                @foreach(config('bank.bank_name') as $moduleItem)
                                                    <option value="{{$moduleItem}}">{{$moduleItem}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group required">
                                            <label for="branch" class="input-label ">Chi nhánh ngân hàng </label>
                                            <select class="js-select2-custom custom-select" size="1" required
                                                    style="opacity: 0;" name="branch" id="branch"
                                                    data-hs-select2-options='{
                                                      "placeholder": "Chọn chi nhánh ngân hàng",
                                                      "searchInputPlaceholder": "Search a branch"}'>
                                                <option value=""></option>
                                                @foreach(config('bank.branch') as $moduleItem)
                                                    <option value="{{$moduleItem}}">{{$moduleItem}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Footer --}}
                            <div class="card-footer d-flex justify-content-end align-items-center">
                                <a class="btn btn-outline-primary mr-2" href="bank/list">Cancel</a>
                                <button type="submit" class="btn btn-primary">Add Bank User</button>
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
