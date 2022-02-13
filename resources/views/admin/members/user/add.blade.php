@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.add.headerPage', [
                     'breadcrumb_list' => 'user/list',
                     'breadcrumb' => 'Users',
                     'page' => 'Add',
                     'pagetitle' => 'Thêm người dùng mới',
                     'linklist' => 'user/list',
                     'list' => 'List User'
                 ])
            {{-- End Page Header --}}

            @include('admin.layout.alert')

            {{-- Step Form --}}
            <form action="" method="post" id="addUser" class="js-step-form py-md-5" enctype="multipart/form-data"
                  data-hs-step-form-options='{"progressSelector": "#addUserStepFormProgress", "isValidate": true,
                    "stepsSelector": "#addUserStepFormContent", "endSelector": "#addUserFinishBtn"}'>
                @csrf

                <div class="row justify-content-lg-center">
                    <div class="col-lg-7">
                        {{-- Step --}}
                        <ul id="addUserStepFormProgress"
                            class="js-step-progress step step-sm step-icon-sm step step-inline step-item-between mb-3 mb-md-5">
                            <li class="step-item">
                                <a class="step-content-wrapper" href="javascript:"
                                   data-hs-step-form-next-options='{"targetSelector": "#addUserStepProfile"}'>
                                    <span class="step-icon step-icon-soft-dark">1</span>
                                    <div class="step-content">
                                        <span class="step-title">Thông tin cá nhân</span>
                                    </div>
                                </a>
                            </li>

                            <li class="step-item">
                                <a class="step-content-wrapper" href="javascript:"
                                   data-hs-step-form-next-options='{"targetSelector": "#addUserStepSecurity"}'>
                                    <span class="step-icon step-icon-soft-dark">2</span>
                                    <div class="step-content">
                                        <span class="step-title">Chi tiết bảo mật</span>
                                    </div>
                                </a>
                            </li>

                            <li class="step-item">
                                <a class="step-content-wrapper" href="javascript:"
                                   data-hs-step-form-next-options='{"targetSelector": "#addUserStepConfirmation"}'>
                                    <span class="step-icon step-icon-soft-dark">3</span>
                                    <div class="step-content">
                                        <span class="step-title">Xác nhận</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                        {{-- End Step --}}

                        {{-- Content Step Form --}}
                        <div id="addUserStepFormContent">
                            <div id="addUserStepProfile" class="card card-lg active">
                                <div class="card-body">
                                    {{-- Form Group Họ và tên --}}
                                    <div class="row form-group required ">
                                        <label class="col-sm-3 col-form-label input-label">Họ và tên </label>
                                        <div class="col-sm-9 input-group-hover-light">
                                            <input type="text" class="form-control " name="name" id="name"
                                                   value="{{ old('name') }}" placeholder="Họ và tên" required>
                                        </div>
                                    </div>
                                    {{-- End Form Group Họ và tên --}}

                                    {{-- Form Group Email --}}
                                    <div class="row form-group required">
                                        <label for="email" class="col-sm-3 col-form-label input-label">Email </label>
                                        <div class="col-sm-9 input-group-hover-light">
                                            <input type="email" class="form-control" name="email" id="email"
                                                   value="{{ old('email') }}" placeholder="vidu@gmail.com"
                                                   autocomplete="username" required>
                                        </div>
                                    </div>
                                    {{-- End Form Group Email --}}

                                    {{-- Form Group Số điện thoại --}}
                                    <div class="row form-group required ">
                                        <label class="col-sm-3 col-form-label input-label" for="phone">Số điện
                                            thoại </label>
                                        <div class="col-sm-9 input-group-hover-light">
                                            <input type="number" class="form-control" name="phone" id="phone"
                                                   value="{{ old('phone') }}" placeholder="Nhập số điện thoại" required>
                                        </div>
                                    </div>
                                    {{-- End Form Group Số điện thoại --}}

                                    {{-- Form Group Ngày sinh --}}
                                    <div class="row form-group required">
                                        <label for="birthday" class="col-sm-3 col-form-label input-label">Ngày
                                            sinh </label>
                                        <div class="col-sm-9 input-group-hover-light">
                                            <input type="date" class="form-control" name="birthday" id="birthday"
                                                   value="{{ old('birthday') }}" required>
                                        </div>
                                    </div>
                                    {{-- End Form Group Ngày sinh --}}

                                    {{-- Form Group Địa chỉ --}}
                                    <div class="row form-group required">
                                        <label for="address" class="col-sm-3 col-form-label input-label">Địa chỉ</label>
                                        <div class="col-sm-9 input-group-hover-light">
                                            <input type="text" class="form-control" name="address" id="address"
                                                   value="{{ old('address') }}" required
                                                   placeholder="Nhập địa chỉ, số nhà, ngõ, quận huyện xã, tỉnh thành phố">
                                        </div>
                                    </div>
                                    {{-- End Form Group Địa chỉ --}}

                                    {{-- Form Group Giới tính --}}
                                    <div class="row form-group required">
                                        <label class="col-sm-3 col-form-label input-label">Giới tính </label>
                                        <div class="input-group col-sm-5 input-group-hover-light">
                                            {{-- Custom Radio Nam --}}
                                            <div class="form-control">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="gender"
                                                           id="male" value="1">
                                                    <label class="custom-control-label" for="male"> Nam </label>
                                                </div>
                                            </div>
                                            {{-- End Custom Radio Nam --}}

                                            {{-- Custom Radio Nữ --}}
                                            <div class="form-control">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" class="custom-control-input" name="gender"
                                                           id="female" value="0" checked="checked">
                                                    <label class="custom-control-label" for="female"> Nữ </label>
                                                </div>
                                            </div>
                                            {{-- End Custom Radio Nữ --}}
                                        </div>
                                    </div>
                                    {{-- End Form Group Giới tính --}}

                                    {{-- Form Group Địa chỉ --}}
                                    <div class="row form-group">
                                        <label for="address" class="col-sm-3 col-form-label input-label">Tên
                                            Team</label>
                                        <div class="col-sm-9 input-group-hover-light">
                                            <input type="text" class="form-control" name="team" id="team"
                                                   value="{{ old('team') }}"
                                                   placeholder="Nếu là Agency thì điền team, không thì bỏ trống">
                                        </div>
                                    </div>
                                    {{-- End Form Group Địa chỉ --}}
                                </div>

                                {{-- Footer --}}
                                <div class="card-footer d-flex justify-content-end align-items-center">
                                    <button type="button" class="btn btn-primary"
                                            data-hs-step-form-next-options='{"targetSelector": "#addUserStepSecurity"}'>
                                        Tiếp theo <i class="tio-chevron-right"></i>
                                    </button>
                                </div>
                                {{-- End Footer --}}
                            </div>

                            <div id="addUserStepSecurity" class="card card-lg" style="display: none;">
                                <div class="card-body">

                                    {{-- Form Group Link Facebook --}}
                                    <div class="row form-group required">
                                        <label for="facebook" class="col-sm-3 col-form-label input-label">Link
                                            Facebook</label>
                                        <div class="col-sm-9 input-group-hover-light">
                                            <input type="text" class="form-control" name="facebook" id="facebook"
                                                   value="{{ old('facebook') }}" placeholder="Link Facebook" required>
                                        </div>
                                    </div>
                                    {{-- End Form Group Link Facebook --}}

                                    {{-- Form Group Username --}}
                                    <div class="row form-group required">
                                        <label for="username"
                                               class="col-sm-3 col-form-label input-label">Username</label>
                                        <div class="col-sm-9 input-group-hover-light">
                                            <input type="text" class="form-control" name="username" id="username"
                                                   value="{{ old('username') }}" placeholder="Username"
                                                   autocomplete="username" required>
                                        </div>
                                    </div>
                                    {{-- End Form Group Username --}}

                                    {{-- Form Group Mật khẩu --}}
                                    <div class="row form-group required">
                                        <label for="password"
                                               class="col-sm-3 col-form-label input-label ">Mật khẩu</label>
                                        <div class="col-sm-9 input-group-hover-light">
                                            <input type="password" class="form-control js-toggle-password "
                                                   name="password" id="password" autocomplete="new-password"
                                                   placeholder="Mật khẩu từ 8 đến 32 ký tự gồm số và chữ" required>
                                        </div>
                                    </div>
                                    {{-- End Form Group Mật khẩu --}}

                                    {{-- Form Group Nhập lại mật khẩu --}}
                                    <div class="row form-group required">
                                        <label for="confirmpassword" class="col-sm-3 col-form-label input-label">Nhập
                                            lại mật khẩu</label>
                                        <div class="col-sm-9 input-group-hover-light">
                                            <input type="password" class="form-control js-toggle-password"
                                                   name="confirmpassword" id="confirmpassword" required
                                                   autocomplete="new-password" placeholder="Nhập lại mật khẩu">
                                        </div>
                                    </div>
                                    {{-- End Form Group Nhập lại mật khẩu --}}

                                    {{-- Form Group Position --}}
                                    <div class="row form-group required">
                                        <label for="position"
                                               class="col-sm-3 col-form-label input-label">Position</label>
                                        <div class="col-sm-9 input-group-hover-light">
                                            <select id="position" name="position" style="opacity: 0;"
                                                    class="js-select2-custom custom-select" size="1"
                                                    data-hs-select2-options='{"minimumResultsForSearch": "Infinity",
                                                    "placeholder": "Select Position"}'>
                                                <option value="1">Administrator (Admin)</option>
                                                <option value="2">Supermoderator (Smod)</option>
                                                <option value="3">Moderator (Mod)</option>
                                                <option value="4">Agency</option>
                                                <option value="5" selected>User</option>
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Form Group Role --}}
                                    <div class="row form-group">
                                        <label for="role" class="col-sm-3 col-form-label input-label">Permision</label>
                                        <div class="col-sm-9 input-group-hover-light">
                                            <select id="role" name="role[]" class="js-select2-custom custom-select"
                                                    multiple size="1" style="opacity: 0;" data-hs-select2-options='{
                                                    "minimumResultsForSearch": "Infinity", "placeholder": "Chọn nhóm quyền"}'>
                                                @foreach($roles as $role)
                                                    <option value="{{$role->id}}">{{$role->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    {{-- Form Group Status --}}
                                    <div class="row form-group required">
                                        <label for="status" class="col-sm-3 col-form-label input-label">Status</label>
                                        <div class="col-sm-9 input-group-hover-light">
                                            <div class="input-group input-group-sm-down-break">

                                                {{-- Custom Radio Status Acitved --}}
                                                <div class="form-control">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" name="status"
                                                               id="actived" value="1" checked="">
                                                        <label class="custom-control-label" for="actived">
                                                            Actived</label>
                                                    </div>
                                                </div>
                                                {{-- End Custom Radio Status Acitve --}}

                                                {{-- Custom Radio Status Not activated --}}
                                                <div class="form-control">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" name="status"
                                                               id="notactived" value="0">
                                                        <label class="custom-control-label" for="notactived">
                                                            Not activated</label>
                                                    </div>
                                                </div>
                                                {{-- End Custom Radio Not activated --}}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Form Group Status --}}
                                </div>

                                {{-- Footer --}}
                                <div class="card-footer d-flex align-items-center">
                                    <button type="button" class="btn btn-ghost-secondary"
                                            data-hs-step-form-prev-options='{"targetSelector": "#addUserStepProfile" }'>
                                        <i class="tio-chevron-left"></i> Quay lại
                                    </button>

                                    <div class="ml-auto">
                                        <button type="button" class="btn btn-primary show_view"
                                                data-hs-step-form-next-options='{
                                                    "targetSelector": "#addUserStepConfirmation"}'>
                                            Tiếp tục <i class="tio-chevron-right"></i>
                                        </button>
                                    </div>
                                </div>
                                {{-- End Footer --}}
                            </div>

                            <div id="addUserStepConfirmation" class="card card-lg" style="display: none;">
                                {{-- Profile Cover --}}
                                <div class="profile-cover">
                                    <div class="profile-cover-img-wrapper">
                                        <img class="profile-cover-img"
                                             src="{{asset('/assets/images/1920x400/img1.jpg')}}" alt="">
                                    </div>
                                </div>
                                {{-- End Profile Cover --}}

                                {{-- Avatar --}}
                                <label class="avatar avatar-xxl avatar-circle avatar-border-lg profile-cover-avatar"
                                       for="avatar">
                                    <img id="avatarImg" class="avatar-img" alt="Chọn ảnh đại diện"
                                         src="{{asset('/assets/images/160x160/img1.jpg')}}">

                                    <input type="file" class="js-file-attach avatar-uploader-input" name="avatar"
                                           id="avatar" accept="image/*" size="15360" required
                                           data-hs-file-attach-options='{"textTarget": "#avatarImg",
                                                "mode": "image", "targetAttr": "src",
                                                "resetTarget": ".js-file-attach-reset-img",
                                                "resetImg": "/assets/images/160x160/img1.jpg",
                                                "allowTypes": [".png", ".jpeg", ".jpg", ".gif", ".svg"]}'>
                                    <span class="avatar-uploader-trigger">
                                            <i class="tio-edit avatar-uploader-icon shadow-soft"></i>
                                    </span>
                                </label>
                                {{-- End Avatar --}}

                                {{-- Body --}}
                                <div class="card-body show">
                                    <div class="col-lg-12 ml-5 row ">
                                        <div class="col-lg-6">
                                            <dl class="row">
                                                <dt class="col-sm-4">Họ và tên:</dt>
                                                <dd class="col-sm-8" id="nameview"></dd>

                                                <dt class="col-sm-4">Username:</dt>
                                                <dd class="col-sm-8" id="usernameview"></dd>

                                                <dt class="col-sm-4">Email:</dt>
                                                <dd class="col-sm-8" id="emailview"></dd>

                                                <dt class="col-sm-4">Số điện thoại:</dt>
                                                <dd class="col-sm-8" id="phoneview"></dd>

                                                <dt class="col-sm-4">Ngày sinh:</dt>
                                                <dd class="col-sm-8" id="birthdayview"></dd>
                                            </dl>
                                        </div>
                                        <div class="col-lg-6">
                                            <dl class="row">
                                                <dt class="col-sm-4">Giới tính:</dt>
                                                <dd class="col-sm-8" id="genderview"></dd>

                                                <dt class="col-sm-4">Chức vụ:</dt>
                                                <dd class="col-sm-8" id="positionview"></dd>

                                                <dt class="col-sm-4">Quyền hạn:</dt>
                                                <dd class="col-sm-8" id="permissionview"></dd>

                                                <dt class="col-sm-4">Active:</dt>
                                                <dd class="col-sm-8" id="statusview"></dd>

                                                <dt class="col-sm-4">Boss Team:</dt>
                                                <dd class="col-sm-8" id="teamview"></dd>
                                            </dl>
                                        </div>

                                        <dt class="col-lg-2">Địa chỉ:</dt>
                                        <dd class="col-lg-10" id="addressview"></dd>

                                        <dt class="col-lg-2">Link Facebook:</dt>
                                        <dd class="col-lg-10" id="facebookview"></dd>

                                    </div>
                                </div>
                                {{-- End Body --}}

                                {{-- Footer --}}
                                <div class="card-footer d-flex align-items-center">
                                    <button type="button" class="btn btn-ghost-secondary"
                                            data-hs-step-form-prev-options='{"targetSelector": "#addUserStepSecurity"}'>
                                        <i class="tio-chevron-left"></i>Quay lại
                                    </button>

                                    <div class="ml-auto">
                                        <button type="submit" class="btn btn-primary">Đăng ký</button>
                                    </div>
                                </div>
                                {{-- End Footer --}}
                            </div>
                        </div>
                        {{-- End Content Step Form --}}
                    </div>
                </div>
            </form>
            {{-- End Step Form --}}
        </div>
    </main>
@endsection

@section('js')
    <script src="{{asset('/assets/js/custom/members/user/user_add.js')}}"></script>
@endsection
