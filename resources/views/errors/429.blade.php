<!DOCTYPE html>
<html lang="en">
<head>
    {{-- Required Meta Tags Always Come First --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{-- Title --}}
    <title>Error 403 | Tribe - Admin </title>

    {{-- Favicon --}}
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">

    {{-- Font --}}
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

    {{-- CSS Implementing Plugins --}}
    <link rel="stylesheet" href="{{asset('/assets/css/vendor.min.css')}}">

    {{-- CSS Front Template --}}
    <link rel="stylesheet" href="{{asset('/assets/css/theme.min.css?v=1.0')}}">
</head>

<body >
{{-- ========== MAIN CONTENT ========== --}}
<main id="content" role="main" class="main" >
    {{-- Content --}}
    <div class="container">
        <a class="position-absolute top-0 left-0 right-0" href="/admin">
            <img class="avatar avatar-xxl avatar-4by3 avatar-centered" src="{{asset('/assets/svg/logos/tribepng.png')}}" style="width: 300px; height: 100px" alt="Image Description">
        </a>

        <div class="footer-height-offset d-flex justify-content-center align-items-center flex-column">
            <div class="row align-items-sm-center w-100">
                <div class="col-sm-6">
                    <div class="text-center text-sm-right mr-sm-4 mb-5 mb-sm-0">
                        <img class="w-60 w-sm-100 mx-auto" src="{{asset('/assets/svg/illustrations/think.svg')}}" alt="Image Description" style="max-width: 15rem;">
                    </div>
                </div>

                <div class="col-sm-6 col-md-4 text-center text-sm-left">
                    <h1 class="display-1 mb-0">Cảnh báo!</h1>
                    <p class="lead">Bạn đã nhập sai tài khoản hoặc mật khẩu quá nhiều lần, vui lòng thử lại sau 5 phút. Nếu không nhớ thông tin đăng nhập vui lòng sủ dụng chức năng quên mật khẩu.</p>
                    <a class="btn btn-primary" href="{{route('login')}}">Đăng nhập</a>
                    <a class="btn btn-outline-primary" href="{{route('login')}}">Quên mật khẩu ?</a>
                </div>
            </div>
            {{-- End Row --}}
        </div>
    </div>
    {{-- End Content --}}

    {{-- Footer --}}
    <div class="footer text-center">
        <ul class="list-inline list-separator">
            <li class="list-inline-item">
                <a class="list-separator-link" href="#">Tribe Support</a>
            </li>

            <li class="list-inline-item">
                <a class="list-separator-link" href="#">Tribe Status</a>
            </li>

            <li class="list-inline-item">
                <a class="list-separator-link" href="#">Get Help</a>
            </li>
        </ul>
    </div>
    {{-- End Footer --}}
</main>
{{-- ========== END MAIN CONTENT ========== --}}


{{-- JS Front --}}
<script src="{{asset('/assets/js/theme.min.js')}}"></script>

{{-- IE Support --}}
<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="./assets/vendor/babel-polyfill/polyfill.min.js"><\/script>');
</script>
</body>
</html>
