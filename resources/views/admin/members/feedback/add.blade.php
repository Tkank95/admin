@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">

            {{-- Page Header --}}
            @include('admin.layout.add.headerPage', [
                     'breadcrumb_list' => 'job/list',
                     'breadcrumb' => 'Apply Jobs',
                     'page' => 'Add',
                     'pagetitle' => 'Đơn đăng ký live',
                     'linklist' => 'job/list',
                     'list' => 'List Apply Jobs'
                 ])
            {{-- End Page Header --}}

            @include('admin.layout.alert')

            <form id="dataLive" action="" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mb-3 mb-lg-5">
                                    {{-- Header --}}
                                    @include('admin.layout.add.headerForm', [
                                         'headertitle' => 'Apply Job Information'
                                     ])
                                    {{-- End Header --}}

                                    <div class="card-body">
                                        <div class="row">
                                            {{-- Form Group Seach User--}}
                                            <div class="col-sm-5">
                                                <div class="form-group required">
                                                    <label for="user_id" class="input-label ">Email</label>
                                                    <select class="js-select2-custom custom-select" size="1" required
                                                            style="opacity: 0;" name="user_id" id="user_id"
                                                            data-hs-select2-options='{
                                                                  "placeholder": "Chọn email tìm kiếm user",
                                                                  "searchInputPlaceholder": "Nhập email" }'>
                                                        <option value=""></option>
                                                        @foreach($email as $item)
                                                            <option value="{{$item->id}}">{{$item->email}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- End Form Group Seach User--}}

                                            {{-- Form Group Category --}}
                                            <div class="col-sm-2">
                                                <div class="form-group required">
                                                    <label for="app_id" class="input-label">Category</label>
                                                    <select class="js-select2-custom custom-select" id="cate" size="1"
                                                            name="cate" style="opacity: 0;" required
                                                            data-hs-select2-options='{"minimumResultsForSearch": "Infinity",
                                                                "placeholder": "Chọn thể loại"}'>
                                                        <option value=""></option>
                                                        @foreach($menus as $cate)
                                                            <option
                                                                value="{{ $cate->id }}">{{ $cate->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- End Form Group Category --}}

                                            {{-- Form Group Application --}}
                                            <div class="col-sm-2">
                                                <div class="form-group required">
                                                    <label for="app_id" class="input-label">Application</label>
                                                    <select class="js-select2-custom custom-select" id="app_id" size="1"
                                                            name="app_id" style="opacity: 0;" disabled required
                                                            data-hs-select2-options='{"minimumResultsForSearch": "Infinity",
                                                                "placeholder": "Loading..."}'>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- End Form Group Application --}}

                                            {{-- Form Group ID in app --}}
                                            <div class="col-sm-3">
                                                <div class="form-group required">
                                                    <label for="id_in_app" class="input-label">Nhập ID tài khoản ứng
                                                        dụng</label>
                                                    <input type="text" class="form-control" name="id_in_app" required
                                                           id="id_in_app" value="{{old('id_in_app')}}"
                                                           placeholder="Nhập ID tài khoản ứng dụng">
                                                </div>
                                            </div>
                                            {{-- End Form Group ID in app --}}
                                        </div>

                                        <div class="row">
                                            {{-- Form Group Team--}}
                                            <div class="col-sm-2">
                                                <div class="form-group required">
                                                    <label for="email" class="input-label ">Tên team Agency</label>
                                                    <select class="js-select2-custom custom-select" size="1"
                                                            style="opacity: 0;" name="team" id="team" required
                                                            data-hs-select2-options='{"placeholder": "Chọn Agency",
                                                                  "searchInputPlaceholder": "Nhập tên team"}'>
                                                        <option value=""></option>
                                                        @foreach($agency as $item)
                                                            <option value="{{$item->team}}">{{$item->team}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- End Form Group Team--}}

                                            {{-- Form Group Talent --}}
                                            <div class="col-sm-3">
                                                <div class="form-group required">
                                                    <label for="talent" class="input-label">Tài năng</label>
                                                    <select class="js-select2-custom custom-select" size="1"
                                                            style="opacity: 0;" name="talent" id="talent" required
                                                            data-hs-select2-options='{"placeholder": "Chọn nội dung live",
                                                                  "searchInputPlaceholder": "Chọn nội dung live của bạn"
                                                                }'>
                                                        <option value=""></option>
                                                        @foreach(config('talent.talent') as $moduleItem)
                                                            <option value="{{$moduleItem}}">{{$moduleItem}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- End Form Group Talent --}}

                                            {{-- Form Group Game live --}}
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <label for="experience" class="input-label">Game live</label>
                                                    <input type="text" class="form-control" name="game" id="game"
                                                           value="{{old('game')}}" disabled
                                                           placeholder="Game đăng ký live">
                                                </div>
                                            </div>
                                            {{-- End Form Group Game live --}}

                                            {{-- Form Group Nickname --}}
                                            <div class="col-sm-3">
                                                <div class="form-group required">
                                                    <label for="nickname" class="input-label">Nickname tài khoản ứng
                                                        dụng</label>
                                                    <input type="text" class="form-control" name="nickname" required
                                                           id="nickname" value="{{old('nickname')}}"
                                                           placeholder="Nickname trong app">
                                                </div>
                                            </div>
                                            {{-- End Form Group Nickname --}}
                                        </div>

                                        <div class="row">
                                            {{-- Form Group Số CMND/CCCD --}}
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <label for="video_proof" class="input-label">Số CMND/CCCD</label>
                                                    <input type="number" class="form-control" name="number_cmnd"
                                                           id="number_cmnd" value="{{old('number_cmnd')}}"
                                                           placeholder="9 hoặc 12 số">
                                                </div>
                                            </div>
                                            {{-- End Form Group Số CMND/CCCD --}}

                                            {{-- Form Group Ngày casting --}}
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="video_casting" class="input-label ">Ngày giờ casting</label>
                                                    <div
                                                        class="js-flatpickr flatpickr-custom input-group input-group-merge"
                                                        id="dateCast" data-hs-flatpickr-options='{"appendTo": "#dateCast",
                                                            "dateFormat": "Y/m/d H:i","wrap": true,"enableTime": true,
                                                            "time_24hr": true}'>
                                                        <div class="input-group-prepend" data-toggle="">
                                                            <div class="input-group-text">
                                                                <i class="tio-calendar-month"></i>
                                                            </div>
                                                        </div>

                                                        <input type="text" id="cast_datetime" name="cast_datetime"
                                                               class="flatpickr-custom-form-control form-control"
                                                               placeholder="Chọn ngày giờ cast" data-input=""
                                                               value="{{old('cast_datetime')}}">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Form Group Ngày casting --}}

                                            {{-- Form Group Worked --}}
                                            <div class="col-sm-7">
                                                <div class="form-group required">
                                                    <label for="experience" class="input-label">Đã từng đăng ký làm app này
                                                        trước đây chưa?</label>
                                                    <div class="input-group input-group-md-down-break">
                                                        <div class="form-control col-sm-6">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"
                                                                       name="worked" id="1" value="1">
                                                                <label class="custom-control-label" for="1">Đã từng
                                                                    đăng ký làm app này rồi</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-control col-sm-6">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"
                                                                       name="worked" id="0" value="0" checked>
                                                                <label class="custom-control-label" for="0">Chưa đăng ký
                                                                    làm bao giờ</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Form Group Worked --}}
                                        </div>

                                        <div class="row">
                                            {{-- Form Group Kinh nghiệm live --}}
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="experience" class="input-label">Kinh nghiệm live những
                                                        app nào?</label>
                                                    <input type="text" class="form-control" name="experience"
                                                           id="experience" value="{{old('experience')}}"
                                                           placeholder="Những app từng live">
                                                </div>
                                            </div>
                                            {{-- End Form Group Kinh nghiệm live --}}

                                            {{-- Form Group Link video casting --}}
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="video_casting" class="input-label ">Link video casting
                                                    </label>
                                                    <input type="text" class="form-control" name="video_casting"
                                                           id="video_casting" value="{{old('video_casting')}}"
                                                           placeholder="Link video thể hiện tài năng">
                                                </div>
                                            </div>
                                            {{-- End Form Group Link video casting --}}

                                            {{-- Form Group Link video chứng minh thu nhập --}}
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="video_proof" class="input-label">Link video chứng
                                                        minh thu nhập</label>
                                                    <input type="text" class="form-control" name="video_proof"
                                                           id="video_proof" value="{{old('video_proof')}}"
                                                           placeholder="Video thu nhập ở app khác">
                                                </div>
                                            </div>
                                            {{-- End Form Group Link video chứng minh thu nhập --}}

                                            {{-- Form Group Link ảnh rank trong game --}}
                                            <div class="col-sm-3">
                                                <div class="form-group">
                                                    <label for="rank_image" class="input-label">Link ảnh rank trong
                                                        game</label>
                                                    <input type="text" class="form-control" name="rank_image"
                                                           id="rank_image" value="{{old('video_proof')}}"
                                                           placeholder="Tải ảnh rank lên google drive">
                                                </div>
                                            </div>
                                            {{-- End Form Group Link ảnh rank trong game --}}
                                        </div>

                                        {{-- Image CMND --}}
                                        <div class="row">
                                            {{-- Ảnh CMND/CCCD mặt trước --}}
                                            <div class="col-sm-6">
                                                @include('admin.layout.add.image', [
                                                        'name_img' => 'cmnd_mt',
                                                        'class' => 'cmnd_mt',
                                                        'label' => 'Ảnh CMND/CCCD mặt trước',
                                                        'tooltip' => 'Ảnh chụp rõ nét chi tiết'
                                                    ])
                                            </div>
                                            {{-- End Ảnh CMND/CCCD mặt trước --}}

                                            {{-- Ảnh CMND/CCCD mặt sau --}}
                                            <div class="col-sm-6">
                                                @include('admin.layout.add.image', [
                                                        'name_img' => 'cmnd_ms',
                                                        'class' => 'cmnd_ms_img',
                                                        'label' => 'Ảnh CMND/CCCD mặt sau',
                                                        'tooltip' => 'Ảnh chụp rõ nét chi tiết'
                                                    ])
                                            </div>
                                            {{-- End Ảnh CMND/CCCD mặt sau --}}
                                        </div>
                                        {{-- End CMND --}}

                                        {{-- Chụp cùng CMND --}}
                                        <div class="row">
                                            {{-- Ảnh CMND/CCCD chụp cùng mặt --}}
                                            <div class="col-sm-6">
                                                @include('admin.layout.add.image', [
                                                        'name_img' => 'selfie_cmnd',
                                                        'class' => 'selfie_cmnd',
                                                        'label' => 'Ảnh CMND/CCCD chụp cùng mặt',
                                                        'tooltip' => 'Ảnh chụp rõ nét chi tiết'
                                                    ])
                                            </div>
                                            {{-- End Ảnh CMND/CCCD chụp cùng mặt --}}

                                            {{-- Ảnh chụp mặt Idol cầm giấy ghi tên team --}}
                                            <div class="col-sm-6">
                                                @include('admin.layout.add.image', [
                                                        'name_img' => 'selfie_team',
                                                        'class' => 'selfie_team_img',
                                                        'label' => 'Ảnh chụp mặt Idol cầm giấy ghi tên team',
                                                        'tooltip' => 'Ảnh chụp rõ nét chi tiết'
                                                    ])
                                            </div>
                                            {{-- End Ảnh chụp mặt Idol cầm giấy ghi tên team --}}
                                        </div>
                                        {{-- End Chụp cùng CMND --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card">
                            {{-- Header --}}
                            <div class="card-header">
                                <h4 class="card-header-title">User Information</h4>
                            </div>
                            {{-- End Header --}}

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="fullname" class="input-label ">Họ và tên</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-user-big-outlined"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="fullname" id="fullname" disabled
                                               placeholder="Chọn email để hiển thị">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="username" class="input-label ">Username</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-incognito"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="username" id="username" disabled
                                               placeholder="Chọn email để hiển thị">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="gender" class="input-label ">Giới tính</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-robot"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="gender" id="gender" disabled
                                               placeholder="Chọn email để hiển thị">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="gender" class="input-label ">Chức vụ</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-medal"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="position" id="position" disabled
                                               placeholder="Chọn email để hiển thị">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="phone" class="input-label ">Số điện thoại</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-call"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="phone" id="phone" disabled
                                               placeholder="Chọn email để hiển thị">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="birthday" class="input-label ">Ngày sinh</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-birthday-outlined"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="birthday" id="birthday" disabled
                                               placeholder="Chọn email để hiển thị">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="facebook" class="input-label ">Facebook</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-facebook-square"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="facebook" id="facebook" disabled
                                               placeholder="Chọn email để hiển thị">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="status" class="input-label ">Trạng tái tài khoản</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-verified"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="status" id="status" disabled
                                               placeholder="Chọn email để hiển thị">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="banned_until" class="input-label ">Banned Until</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <div class="input-group-text">
                                                <i class="tio-blocked"></i>
                                            </div>
                                        </div>
                                        <input type="text" class="form-control" name="banned_until" id="banned_until"
                                               placeholder="Chọn email để hiển thị" disabled>
                                    </div>
                                </div>

                                {{-- Ảnh chụp mặt Idol  --}}
                                <div class="form-group">
                                    @include('admin.layout.add.image', [
                                            'name_img' => 'selfie',
                                            'class' => 'selfie',
                                            'label' => 'Ảnh chụp mặt Idol',
                                            'tooltip' => 'Ảnh chụp rõ nét chi tiết'
                                        ])
                                </div>
                                {{-- End Ảnh chụp mặt Idol  --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="accordion" id="resultCast">
                            <div class="card" id="headingResult">
                                <h4 class="card-header card-btn btn-block" href="javascript:" data-toggle="collapse"
                                    data-target="#result" aria-expanded="true" aria-controls="result">Result Casting
                                    <span class="card-btn-toggle">
                                        <span class="card-btn-toggle-default"><i class="tio-add"></i></span>
                                        <span class="card-btn-toggle-active"><i class="tio-remove"></i></span>
                                    </span>
                                </h4>

                                <div id="result" class="collapse show" aria-labelledby="headingResult"
                                     data-parent="#resultCast">
                                    <div class="card-body">
                                        <div class="row">
                                            {{-- Form Group kết quả casting --}}
                                            <div class="col-sm-2">
                                                <div class="form-group required">
                                                    <label for="result" class="input-label">Kết quả cast</label>
                                                    <select class="js-select2-custom custom-select" id="result" size="1"
                                                            name="result" style="opacity: 0;" required
                                                            data-hs-select2-options='{"minimumResultsForSearch": "Infinity",
                                                                "placeholder": "Chọn kết quả"}'>
                                                        <option value="0"
                                                                data-option-template='<span class="legend-indicator bg-danger"></span>Fail'></option>
                                                        <option value="1"
                                                                data-option-template='<span class="legend-indicator bg-primary"></span>Pass'></option>
                                                        <option value="2"
                                                                data-option-template='<span class="legend-indicator bg-warning"></span>Pending'
                                                                selected></option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- End Form Group kết quả casting --}}

                                            {{-- Form Group mức lương cứng --}}
                                            <div class="col-sm-2">
                                                <div class="form-group required">
                                                    <label for="wage" class="input-label">Mức lương cứng ($)
                                                        <i class="tio-help-outlined text-body ml-1"
                                                           data-toggle="tooltip" data-placement="top"
                                                           title="0: Pending, 1: Chỉ tiêu quà, 2: Top BXH">
                                                        </i></label>
                                                    <input type="text" class="form-control" name="wage" required
                                                           id="wage" value="{{old('wage')}}"
                                                           placeholder="Mặc định là 0 (Pending)">
                                                </div>
                                            </div>
                                            {{-- End Form Group mức lương cứng --}}

                                            {{-- Form Group có hợp đồng hay không --}}
                                            <div class="col-sm-2">
                                                <div class="form-group required">
                                                    <label for="contract" class="input-label">Hợp đồng</label>
                                                    <div class="input-group input-group-md-down-break">
                                                        <div class="form-control col-sm-6">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"
                                                                       name="contract" id="contract_1" value="1">
                                                                <label class="custom-control-label"
                                                                       for="contract_1">Có</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-control col-sm-6">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"
                                                                       name="contract" id="contract_0" value="0"
                                                                       checked>
                                                                <label class="custom-control-label" for="contract_0">Không</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Form Group có hợp đồng hay không --}}

                                            {{-- Form Group trạng thái hợp đồng --}}
                                            <div class="col-sm-2">
                                                <div class="form-group required">
                                                    <label for="contract_status" class="input-label">Trạng thái hợp
                                                        đồng</label>
                                                    <select class="js-select2-custom custom-select" id="contract_status"
                                                            size="1"
                                                            name="contract_status" style="opacity: 0;" required disabled
                                                            data-hs-select2-options='{"minimumResultsForSearch": "Infinity"}'>
                                                        <option value="0"
                                                                data-option-template='<span class="legend-indicator bg-danger"></span>Chưa gửi'></option>
                                                        <option value="1"
                                                                data-option-template='<span class="legend-indicator bg-primary"></span>Done'></option>
                                                        <option value="2"
                                                                data-option-template='<span class="legend-indicator bg-success"></span>Đã gửi, chưa ký'></option>
                                                        <option value="3"
                                                                data-option-template='<span class="legend-indicator bg-info"></span>Fail, đã gửi ký lại'></option>
                                                        <option value="4" selected
                                                                data-option-template='<span class="legend-indicator bg-warning"></span>No Contract'></option>
                                                    </select>
                                                </div>
                                            </div>
                                            {{-- End Form Group trạng thái hợp đồng --}}

                                            {{-- Form Group Trạng thái hiệu lực live --}}
                                            <div class="col-sm-2">
                                                <div class="form-group required">
                                                    <label for="active" class="input-label">Trạng thái hiệu lực
                                                        live</label>
                                                    <div class="input-group input-group-md-down-break">
                                                        <div class="form-control col-sm-6">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"
                                                                       name="active" id="active_1" value="1" checked>
                                                                <label class="custom-control-label" for="active_1">Active</label>
                                                            </div>
                                                        </div>
                                                        <div class="form-control col-sm-6">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" class="custom-control-input"
                                                                       name="active" id="active_0" value="0">
                                                                <label class="custom-control-label" for="active_0">Expired</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Form Group Trạng thái hiệu lực live --}}

                                            {{-- Form Group Link chính sách lương --}}
                                            <div class="col-sm-2">
                                                <div class="form-group required">
                                                    <label for="policy" class="input-label">Link chính sách
                                                        lương</label>
                                                    <input type="text" class="form-control" name="policy" required
                                                           id="policy" value="{{old('policy')}}"
                                                           placeholder="Chính sách lương áp dụng">
                                                </div>
                                            </div>
                                            {{-- End Form Group Link chính sách lương --}}
                                        </div>

                                        <div class="row">
                                            {{-- Form Group Ngày đậu casting --}}
                                            <div class="col-sm-2">
                                                <div class="form-group required">
                                                    <label for="pass_date" class="input-label">Ngày đậu casting</label>
                                                    <div
                                                        class="js-flatpickr flatpickr-custom input-group input-group-merge"
                                                        id="passDate" data-hs-flatpickr-options='{"appendTo": "#passDate",
                                                            "dateFormat": "Y/m/d","wrap": true}'>
                                                        <div class="input-group-prepend" data-toggle="">
                                                            <div class="input-group-text">
                                                                <i class="tio-date-range"></i>
                                                            </div>
                                                        </div>

                                                        <input type="text" id="pass_date" name="pass_date"
                                                               class="flatpickr-custom-form-control form-control"
                                                               placeholder="Chọn ngày đậu cast" data-input=""
                                                               value="{{old('pass_date')}}">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Form Group Ngày đậu casting --}}

                                            {{-- Form Group Ngày bắt đầu tính dữ liệu live --}}
                                            <div class="col-sm-2">
                                                <div class="form-group required">
                                                    <label for="start_day" class="input-label">Ngày bắt đầu tính dữ liệu
                                                        live</label>
                                                    <div
                                                        class="js-flatpickr flatpickr-custom input-group input-group-merge"
                                                        id="startDay" data-hs-flatpickr-options='{"appendTo": "#startDay",
                                                            "dateFormat": "Y/m/d","wrap": true}'>
                                                        <div class="input-group-prepend" data-toggle="">
                                                            <div class="input-group-text">
                                                                <i class="tio-date-range"></i>
                                                            </div>
                                                        </div>

                                                        <input type="text" id="start_day" name="start_day"
                                                               class="flatpickr-custom-form-control form-control"
                                                               placeholder="Ngày bắt đầu live" data-input=""
                                                               value="{{old('start_day')}}">
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Form Ngày bắt đầu tính dữ liệu live --}}

                                            {{-- Form Group Ghi chú --}}
                                            <div class="col-sm-8">
                                                <div class="form-group required">
                                                    <label for="note" class="input-label">Ghi chú</label>
                                                    <textarea name="note" id="note" class="form-control tinymce"
                                                              placeholder="Nhập ghi chú" rows="15">
                                                              {{ old('note') }}</textarea>
                                                </div>
                                            </div>
                                            {{-- End Form Group Ghi chú --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Footer --}}
                <div class="card-footer d-flex justify-content-end align-items-center">
                    <a class="btn btn-outline-primary mr-2" href="job/list">Cancel</a>
                    <button type="submit" class="btn btn-primary">Add Apply Job</button>
                </div>
                {{-- End Footer --}}
            </form>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{asset('/assets/js/tinymce/tinymce.min.js')}}"></script>
    <script src="{{asset('/assets/js/custom/members/apply_job/applyJob.js')}}"></script>
@endsection
