<!DOCTYPE html>
<html lang="vi">
<head>

    {{-- Link ref --}}
@include('admin.layout.link')
{{-- End Link ref --}}

</head>

<body class="footer-offset">

{{-- Builder --}}
@include('admin.layout.builder')
{{-- End Builder --}}

{{-- Builder Toggle --}}
<div class="d-none d-md-block position-fixed bottom-0 right-0 mr-5 mb-10" style="z-index: 3;">
    <div
        style="position: fixed; top: 50%; right: 0; margin-right: -.25rem; transform: translateY(-50%); writing-mode: vertical-rl; text-orientation: sideways;">
        <div class="hs-unfold">
            <a id="builderPopover" class="js-hs-unfold-invoker btn btn-sm btn-soft-dark py-3" href="javascript:;"
               data-template='<div class="d-none d-md-block popover" role="tooltip">
               <div class="arrow"></div>
               <h3 class="popover-header"></h3>
               <div class="popover-body"></div></div>'
               data-toggle="popover" data-placement="left"
               title="<div class='d-flex align-items-center'>Tribe Builder <a class='close close-light ml-auto'>
               <i id='closeBuilderPopover' class='tio-clear'></i></a></div>"
               data-content="Tùy chỉnh bố cục trang tổng quan của bạn. Chọn một trong những phù hợp nhất với nhu cầu của bạn."
               data-html="true" data-hs-unfold-options='{
                    "target": "#styleSwitcherDropdown",
                    "type": "css-animation",
                    "animationIn": "fadeInRight",
                    "animationOut": "fadeOutRight",
                    "hasOverlay": true,
                    "smartPositionOff": true
               }'>
                <i class="tio-tune mr-2"></i>
                <span class="font-weight-bold text-uppercase">Builder</span>
            </a>
        </div>
    </div>
</div>
{{-- End Builder Toggle --}}

{{-- ========== HEADER ========== --}}

{{-- Header Main --}}
@include('admin.layout.headerMain')
{{-- End Header Main --}}

{{-- Header Fluid --}}
@include('admin.layout.headerFluid')
{{-- End Header Fluid --}}

{{-- Header Double --}}
@include('admin.layout.headerDouble')
{{-- End Header Double --}}

{{-- Sidebar Main --}}
@include('admin.layout.sidebarMain')
{{-- End Sidebar Main --}}

{{-- Sidebar Compact --}}
@include('admin.layout.sidebarCompact')
{{-- End Sidebar Compact --}}

{{-- END ONLY DEV --}}

{{-- Search Form --}}
<div id="searchDropdown" class="hs-unfold-content dropdown-unfold search-fullwidth d-md-none">
    <form class="input-group input-group-merge input-group-borderless">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <i class="tio-search"></i>
            </div>
        </div>

        <input class="form-control rounded-0" type="search" placeholder="Search in front"
               aria-label="Nhập từ khóa tìm kiếm">

        <div class="input-group-append">
            <div class="input-group-text">
                <div class="hs-unfold">
                    <a class="js-hs-unfold-invoker" href="javascript:;" data-hs-unfold-options='{
                           "target": "#searchDropdown",
                           "type": "css-animation",
                           "animationIn": "fadeIn",
                           "hasOverlay": "rgba(46, 52, 81, 0.1)",
                           "closeBreakpoint": "md"
                         }'>
                        <i class="tio-clear tio-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
{{-- End Search Form --}}

{{-- ========== END HEADER ========== --}}

{{-- ========== MAIN CONTENT ========== --}}

@yield('content')

{{-- ========== END MAIN CONTENT ========== --}}

{{-- ========== FOOTER ========== --}}

@include('admin.layout.footer')

{{-- ========== END FOOTER ========== --}}

{{-- ========== SECONDARY CONTENTS ========== --}}

{{-- Activity --}}
@include('admin.layout.activity')
{{-- End Activity --}}

{{-- Welcome Message Modal --}}
{{-- Create a new user Modal --}}
@include('admin.layout.invite_user')
{{-- End Welcome Message Modal --}}
{{-- End Create a new user Modal --}}

{{-- ========== END SECONDARY CONTENTS ========== --}}

{{-- Script --}}
@include('admin.layout.script')
{{-- End Script --}}
@stack('scripts')
<script>
    $(function(){

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

</body>
</html>
