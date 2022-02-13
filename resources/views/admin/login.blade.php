<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tribe Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/vendor.min.css')}}">
    <link rel="stylesheet" href="{{asset('/assets/css/theme.min.css?v=1.0')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/toastr.min.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
<main id="content" role="main" class="main">
    <form method="post" action="{{route('login')}}">
        @csrf
        <div class="position-fixed top-0 right-0 left-0 bg-img-hero"
             style="height: 32rem; background-image: url(/assets/svg/components/abstract-bg-4.svg);">

            {{-- SVG Bottom Shape --}}
            <figure class="position-absolute right-0 bottom-0 left-0">
                <svg preserveaspectratio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px"
                     viewbox="0 0 1921 273">
                    <polygon fill="#fff" points="0,273 1921,273 1921,0 "></polygon>
                </svg>
            </figure>
            {{-- End SVG Bottom Shape --}}
        </div>

        {{-- Content --}}
        <div class="container py-5 py-sm-7">
            <a class="d-flex justify-content-center mb-5" href="/admin">
                <img class="z-index-2" src="{{asset('/assets/svg/logos/tribepng.png')}}" alt="Image Description"
                     style="width: 18rem;">
            </a>

            <div class="row justify-content-center">
                <div class="col-md-7 col-lg-5">
                    <div class="card card-lg mb-5">
                        <div class="card-body">
                            <form class="js-validate">
                                <div class="text-center">
                                    <div class="mb-5">
                                        <h1 class="display-4">Đăng nhập</h1>
                                        <p>Bạn chưa có tài khoản? <a href="">Đăng ký</a></p>
                                    </div>

                                    <a class="btn btn-lg btn-block btn-white mb-4" href="{{ URL::to('auth/google') }}">
                                      <span class="d-flex justify-content-center align-items-center">
                                        <img class="avatar avatar-xss mr-2" alt="Image Description"
                                             src="{{asset('/assets/svg/brands/google.svg')}}"> Sign in with Google
                                      </span>
                                    </a>

                                    <span class="divider text-muted mb-4">OR</span>
                                </div>

                                @include('admin.layout.alert')

                                {{-- Form Group --}}
                                <div class="js-form-message form-group">
                                    <label class="input-label" for="signin">Email hoặc Username</label>
                                    <input type="text" class="form-control form-control-lg " name="signin" id="signin"
                                           tabindex="1" placeholder="Nhập username hoặc email của bạn"
                                           autocomplete="username" required="">
                                </div>
                                {{-- End Form Group --}}

                                {{-- Form Group --}}
                                <div class="js-form-message form-group">
                                    <label class="input-label" for="signupSrPassword" tabindex="0">
                                      <span class="d-flex justify-content-between align-items-center"> Mật khẩu
                                        <a class="input-label-secondary"
                                           href="authentication-reset-password-basic.html">Quên mật khẩu?</a>
                                      </span>
                                    </label>

                                    <div class="input-group input-group-merge">
                                        <input type="password" class="js-toggle-password form-control form-control-lg "
                                               name="password" id="signupSrPassword" placeholder="Nhập mật khẩu của bạn"
                                               data-msg="Mật khẩu của bạn không hợp lệ. Vui lòng thử lại." required=""
                                               aria-label="Nhập mật khẩu của bạn" autocomplete="current-password"
                                               data-hs-toggle-password-options='{"target": "#changePassTarget",
                                               "defaultClass": "tio-hidden-outlined", "showClass": "tio-visible-outlined",
                                               "classChangeTarget": "#changePassIcon"}'>
                                        <div id="changePassTarget" class="input-group-append">
                                            <a class="input-group-text" href="javascript:">
                                                <i id="changePassIcon" class="tio-visible-outlined"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                {{-- End Form Group --}}

                                {{-- Checkbox --}}
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="remember"
                                               name="remember">
                                        <label class="custom-control-label text-muted" for="remember">
                                            Remember me</label>
                                    </div>
                                </div>
                                {{-- End Checkbox --}}

                                <button type="submit" class="btn btn-lg btn-block btn-primary">Sign in</button>
                            </form>
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="text-center">
                        <small class="text-cap mb-4">Tribe Trusted by live streaming apps</small>
                    </div>
                    {{-- End Footer --}}
                </div>
            </div>
        </div>
    </form>
</main>
{{-- ========== END MAIN CONTENT ========== --}}

{{-- JS Implementing Plugins --}}
<script src="{{asset('/assets/js/vendor.min.js')}}"></script>

{{-- JS Front --}}
<script src="{{asset('/assets/js/theme.min.js')}}"></script>
<script src="{{asset('/assets/js/toastr.min.js')}}"></script>

{{-- JS Plugins Init. --}}
<script>
    $(document).on('ready', function () {
        // INITIALIZATION OF SHOW PASSWORD
        // =======================================================
        $('.js-toggle-password').each(function () {
            new HSTogglePassword(this).init()
        });


        // INITIALIZATION OF FORM VALIDATION
        // =======================================================
        $('.js-validate').each(function () {
            $.HSCore.components.HSValidation.init($(this));
        });
    });
</script>
<script>
    $(function () {

        @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
        @endif

        @if(Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
        @endif

        @if(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
        @endif

        @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
        @endif
    });
</script>

{{-- IE Support --}}
<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="public/assets/vendor/babel-polyfill/polyfill.min.js"><\/script>');
</script>
</body>
</html>
