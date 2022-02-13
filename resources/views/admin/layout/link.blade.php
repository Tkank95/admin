{{-- Required Meta Tags Always Come First --}}
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

{{-- Title --}}
<title>{{$title}}</title>

<base href="{{asset('') }}">
{{-- Favicon --}}
<link rel="shortcut icon" href="{{asset('favicon.ico')}}">

{{-- Font --}}
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

{{-- CSS Implementing Plugins --}}
<link rel="stylesheet" href="{{asset('/assets/css/vendor.min.css')}}">
<link rel="stylesheet" href="{{asset('/assets/css/style.css')}}">
<link rel="stylesheet" href="{{asset('/assets/css/fancybox.css')}}">

{{-- CSS Front Template --}}
<link rel="stylesheet" href="{{asset('/assets/css/theme.min.css?v=1.0')}}">

<link rel="stylesheet" type="text/css" href="{{asset('/assets/css/sweetalert2.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('/assets/css/toastr.min.css')}}">

<meta name="csrf-token" content="{{ csrf_token() }}">

@yield('head')
