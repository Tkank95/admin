<script src="{{asset('/assets/js/jquery-3.6.0.min.js')}}"></script>
<script src="{{asset('/assets/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('/assets/js/vendor.min.js')}}"></script>
<script src="{{asset('/assets/js/hs-navbar-vertical-aside-mini-cache.js')}}"></script>

<script src="{{asset('/assets/js/add-method.min.js')}}"></script>
<script src="{{asset('/assets/js/theme.min.js')}}"></script>
<script src="{{asset('/assets/js/fancybox.js')}}"></script>
<script src="{{asset('/assets/js/sweetalert2.min.js')}}"></script>
<script src="{{asset('/assets/js/toastr.min.js')}}"></script>
<script src="{{asset('/assets/js/general.js')}}"></script>

{{-- IE Support --}}
<script>
    if (/MSIE \d|Trident.*rv:/.test(navigator.userAgent)) document.write('<script src="{{asset('/assets/js/babel-polyfill/polyfill.min.js')}}"><\/script>');
</script>

<script type="text/javascript">
    window.toggleSqlDuplicate = function () {
        $('div.phpdebugbar-widgets-sqlqueries li').not('.phpdebugbar-widgets-sql-duplicate').toggleClass('hidden');
    }
</script>

@yield('js')
