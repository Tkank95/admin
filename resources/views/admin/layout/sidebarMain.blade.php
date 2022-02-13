{{-- Sidebar Main --}}
<div id="sidebarMain" class="d-none">
    <aside
        class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered">
        <div class="navbar-vertical-container">
            <div class="navbar-vertical-footer-offset">
                <div class="navbar-brand-wrapper justify-content-between">
                    {{-- Logo --}}

                    <a class="navbar-brand" href="{{route('admin')}}" aria-label="Front">
                        <img class="navbar-brand-logo" src="{{asset('/assets/svg/logos/logo.png')}}" alt="Logo">
                        <img class="navbar-brand-logo-mini" src="{{asset('/assets/svg/logos/logo-short.png')}}"
                             alt="Logo">
                    </a>

                    {{-- End Logo --}}

                    {{-- Navbar Vertical Toggle --}}
                    <button type="button"
                            class="js-navbar-vertical-aside-toggle-invoker navbar-vertical-aside-toggle btn btn-icon btn-xs btn-ghost-dark">
                        <i class="tio-clear tio-lg"></i>
                    </button>
                    {{-- End Navbar Vertical Toggle --}}
                </div>

                {{-- Content --}}
                <div class="navbar-vertical-content">
                    <ul class="navbar-nav navbar-nav-lg nav-tabs">
                        {{-- Dashboards --}}
                        <li class="navbar-vertical-aside-has-menu show">
                            <a class="js-navbar-vertical-aside-menu-link nav-link active" href="{{route('admin')}}"
                               title="Dashboards">
                                <i class="tio-home-vs-1-outlined nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Dashboards</span>
                            </a>
                        </li>
                        {{-- End Dashboards --}}

                        <li class="nav-item">
                            <small class="nav-subtitle" title="Pages">Administrators</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        {{-- Quản lý user --}}
                        <li class="navbar-vertical-aside-has-menu">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                               href="javascript:" title="Quản lý người dùng">
                                <i class="tio-lock-outlined nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Members</span>
                            </a>

                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                                <li class="nav-item">
                                    <a class="nav-link " href="user/add" title="Thêm người dùng">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Add User</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="user/list" title="Danh sách người dùng">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">List User</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="bank/list" title="Thông tin ngân hàng của người dùng">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Info Bank</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="feedback/list" title="Phản hồi người dùng">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Feedback</span>
                                    </a>
                                </li>
                                <li class="navbar-vertical-aside-has-menu ">
                                    <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                       href="javascript:" title="Quản lý công việc, nhiệm vụ">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Task</span>
                                    </a>

                                    <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                                        <li class="nav-item">
                                            <a class="nav-link" href="task/tag/list" title="Loại công việc, nhiệm vụ">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">Category</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="task/list" title="Danh sách công việc, nhiệm vụ">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">List Task</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="task/calendar" title="Lịch làm việc">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">Calendar</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="navbar-vertical-aside-has-menu ">
                                    <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                       href="javascript:" title="Phân quyền người dùng">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Permission</span>
                                    </a>

                                    <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/permission/add" title="Thêm quyền">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">Add Permission</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/role/add" title="Thêm nhóm quyền">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">Add Role</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/role/list" title="Danh sách nhóm quyền">
                                                <span class="tio-circle nav-indicator-icon"></span>
                                                <span class="text-truncate">List Role</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        {{-- End quản lý user --}}

                        {{-- Apps --}}
                        <li class="navbar-vertical-aside-has-menu">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle " href="javascript:"
                               title="Apps">
                                <i class="tio-apps nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Apps <span
                                        class="badge badge-info badge-pill ml-1">Hot</span></span>
                            </a>

                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                                <li class="nav-item">
                                    <a class="nav-link" href="app/add" title="Thêm ứng dụng">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Add App <span
                                                class="badge badge-info badge-pill ml-1">New</span></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="app/list" title="Danh sách ứng dụng">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">List App</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="policy/list" title="Chính sách lương">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Policy</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="rule/list" title="Quy định live">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Live Rule</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="promote/list" title="Đề xuất ứng dụng">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Promote</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- End Apps --}}

                        {{-- Data --}}
                        <li class="navbar-vertical-aside-has-menu">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                               title="Data">
                                <i class="tio-chart-bar-2 nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Data</span>
                            </a>

                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                                <li class="nav-item">
                                    <a class="nav-link" href="job/list" title="Đăng ký live">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Apply Job</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="data/live/list" title="Data Live">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Data Live</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="data/live/list" title="Salary Idol">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Lương Idol</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="data/live/list" title="Salary Agency">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Lương Agency</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- End Data --}}

                        {{-- Tin tức --}}
                        <li class="navbar-vertical-aside-has-menu ">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle " href="javascript:"
                               title="Tin tức">
                                <i class="tio-feed-outlined nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Tin tức</span>
                            </a>

                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                                <li class="nav-item">
                                    <a class="nav-link " href="/news/add" title="Thêm tin mới">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Thêm tin mới</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link " href="/news/list" title="Danh sách tin">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Danh sách tin</span>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link " href="error-500.html" title="Bình luận">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Comment</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- End Tin tức --}}

                        {{--                        --}}{{-- Policy_Idol --}}
                        {{--                        <li class="navbar-vertical-aside-has-menu">--}}
                        {{--                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" title="Policy Idol">--}}
                        {{--                                <i class="tio-money nav-icon"></i>--}}
                        {{--                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Policy Idol <span--}}
                        {{--                                        class="badge badge-info badge-pill ml-1">Hot</span></span>--}}
                        {{--                            </a>--}}

                        {{--                            @foreach($menus as $menu)--}}
                        {{--                                @if($menu->categoryChild->count())--}}
                        {{--                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub">--}}
                        {{--                                    <li class="navbar-vertical-aside-has-menu ">--}}
                        {{--                                        <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" title="Users">--}}
                        {{--                                            <span class="tio-circle nav-indicator-icon"></span>--}}
                        {{--                                            <span class="text-truncate">{{$menu->name}}</span>--}}
                        {{--                                        </a>--}}

                        {{--                                        @if($menu->categoryChild->count())--}}
                        {{--                                        <ul class="js-navbar-vertical-aside-submenu nav nav-sub">--}}
                        {{--                                            @foreach($menu->categoryChild as $menuChild)--}}
                        {{--                                            <li class="nav-item">--}}
                        {{--                                                <a class="nav-link " href="/policy/idol-{{$menuChild->id}}-{{Str::slug($menuChild->name, '-')}}">--}}
                        {{--                                                    <span class="tio-circle-outlined nav-indicator-icon"></span>--}}
                        {{--                                                    <span class="text-truncate">{{$menuChild->name}}</span>--}}
                        {{--                                                </a>--}}
                        {{--                                            </li>--}}
                        {{--                                            @endforeach--}}
                        {{--                                        </ul>--}}
                        {{--                                        @endif--}}
                        {{--                                    </li>--}}
                        {{--                                </ul>--}}
                        {{--                                @else--}}
                        {{--                                    <ul class="js-navbar-vertical-aside-submenu nav nav-sub">--}}
                        {{--                                        <li class="navbar-vertical-aside-has-menu">--}}
                        {{--                                            <a class="nav-link " href="javascript:" title="Đang update">--}}
                        {{--                                                <span class="tio-circle nav-indicator-icon"></span>--}}
                        {{--                                                <span class="text-truncate">{{$menu->name}}</span>--}}
                        {{--                                            </a>--}}
                        {{--                                        </li>--}}
                        {{--                                    </ul>--}}
                        {{--                                @endif--}}
                        {{--                            @endforeach--}}
                        {{--                        </li>--}}
                        {{--                        --}}{{-- End Policy_Idol --}}

                        {{--                        --}}{{-- Policy_Agency --}}
                        {{--                        <li class="navbar-vertical-aside-has-menu ">--}}
                        {{--                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle " href="javascript:"--}}
                        {{--                               title="Policy Agency">--}}
                        {{--                                <i class="tio-incognito nav-icon"></i>--}}
                        {{--                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Policy Agency <span--}}
                        {{--                                        class="badge badge-info badge-pill ml-1">Hot</span></span>--}}
                        {{--                            </a>--}}

                        {{--                            @foreach($menus as $menu)--}}
                        {{--                                @if($menu->categoryChild->count())--}}
                        {{--                                    <ul class="js-navbar-vertical-aside-submenu nav nav-sub">--}}
                        {{--                                        <li class="navbar-vertical-aside-has-menu ">--}}
                        {{--                                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" title="Users">--}}
                        {{--                                                <span class="tio-circle nav-indicator-icon"></span>--}}
                        {{--                                                <span class="text-truncate">{{$menu->name}}</span>--}}
                        {{--                                            </a>--}}

                        {{--                                            @if($menu->categoryChild->count())--}}
                        {{--                                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub">--}}
                        {{--                                                    @foreach($menu->categoryChild as $menuChild)--}}
                        {{--                                                        <li class="nav-item">--}}
                        {{--                                                            <a class="nav-link " href="/policy/idol/{{$menuChild->id}}-{{Str::slug($menuChild->name, '-')}}">--}}
                        {{--                                                                <span class="tio-circle-outlined nav-indicator-icon"></span>--}}
                        {{--                                                                <span class="text-truncate">{{$menuChild->name}}</span>--}}
                        {{--                                                            </a>--}}
                        {{--                                                        </li>--}}
                        {{--                                                    @endforeach--}}
                        {{--                                                </ul>--}}
                        {{--                                            @endif--}}
                        {{--                                        </li>--}}
                        {{--                                    </ul>--}}
                        {{--                                @else--}}
                        {{--                                    <ul class="js-navbar-vertical-aside-submenu nav nav-sub">--}}
                        {{--                                        <li class="navbar-vertical-aside-has-menu">--}}
                        {{--                                            <a class="nav-link " href="javascript:" title="Đang update">--}}
                        {{--                                                <span class="tio-circle nav-indicator-icon"></span>--}}
                        {{--                                                <span class="text-truncate">{{$menu->name}}</span>--}}
                        {{--                                            </a>--}}
                        {{--                                        </li>--}}
                        {{--                                    </ul>--}}
                        {{--                                @endif--}}
                        {{--                            @endforeach--}}
                        {{--                        </li>--}}
                        {{--                        --}}{{-- End Policy_Agency --}}

                        {{--                        --}}{{-- Live Rule --}}
                        {{--                        <li class="navbar-vertical-aside-has-menu ">--}}
                        {{--                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"--}}
                        {{--                               title="Live Rule">--}}
                        {{--                                <i class="tio-pin-outlined nav-icon"></i>--}}
                        {{--                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Live Rule <span--}}
                        {{--                                        class="badge badge-info badge-pill ml-1">Hot</span></span>--}}
                        {{--                            </a>--}}

                        {{--                            @foreach($menus as $menu)--}}
                        {{--                                @if($menu->categoryChild->count())--}}
                        {{--                                    <ul class="js-navbar-vertical-aside-submenu nav nav-sub">--}}
                        {{--                                        <li class="navbar-vertical-aside-has-menu ">--}}
                        {{--                                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:" title="Users">--}}
                        {{--                                                <span class="tio-circle nav-indicator-icon"></span>--}}
                        {{--                                                <span class="text-truncate">{{$menu->name}}</span>--}}
                        {{--                                            </a>--}}

                        {{--                                            @if($menu->categoryChild->count())--}}
                        {{--                                                <ul class="js-navbar-vertical-aside-submenu nav nav-sub">--}}
                        {{--                                                    @foreach($menu->categoryChild as $menuChild)--}}
                        {{--                                                        <li class="nav-item">--}}
                        {{--                                                            <a class="nav-link " href="/policy/idol/{{$menuChild->id}}-{{Str::slug($menuChild->name, '-')}}">--}}
                        {{--                                                                <span class="tio-circle-outlined nav-indicator-icon"></span>--}}
                        {{--                                                                <span class="text-truncate">{{$menuChild->name}}</span>--}}
                        {{--                                                            </a>--}}
                        {{--                                                        </li>--}}
                        {{--                                                    @endforeach--}}
                        {{--                                                </ul>--}}
                        {{--                                            @endif--}}
                        {{--                                        </li>--}}
                        {{--                                    </ul>--}}
                        {{--                                @else--}}
                        {{--                                    <ul class="js-navbar-vertical-aside-submenu nav nav-sub">--}}
                        {{--                                        <li class="navbar-vertical-aside-has-menu">--}}
                        {{--                                            <a class="nav-link " href="javascript:" title="Đang update">--}}
                        {{--                                                <span class="tio-circle nav-indicator-icon"></span>--}}
                        {{--                                                <span class="text-truncate">{{$menu->name}}</span>--}}
                        {{--                                            </a>--}}
                        {{--                                        </li>--}}
                        {{--                                    </ul>--}}
                        {{--                                @endif--}}
                        {{--                            @endforeach--}}
                        {{--                        </li>--}}
                        {{--                        --}}{{-- End Live Rule --}}


                        {{-- Money Bill  --}}
                        <li class="navbar-vertical-aside-has-menu">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                               title="Chi phí và thu nhập"><i class="tio-receipt-outlined nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Money Bill</span>
                            </a>

                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                                <li class="navbar-vertical-aside-has-menu ">
                                    <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                       href="javascript:" title="Chi phí thanh toán">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Expense</span>
                                    </a>

                                    <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                                        <li class="nav-item">
                                            <a class="nav-link " href="transaction/expense/category/list"
                                               title="Loại chi phí thanh toán">
                                                <span class="tio-circle-outlined nav-indicator-icon"></span>
                                                <span class="text-truncate">Category</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="transaction/expense/list"
                                               title="Danh sách chi phí thanh toán">
                                                <span class="tio-circle-outlined nav-indicator-icon"></span>
                                                <span class="text-truncate">List Expense</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="navbar-vertical-aside-has-menu ">
                                    <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle"
                                       href="javascript:" title="Thu nhập">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Income</span>
                                    </a>

                                    <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                                        <li class="nav-item">
                                            <a class="nav-link " href="income/category/list" title="Loại thu nhập">
                                                <span class="tio-circle-outlined nav-indicator-icon"></span>
                                                <span class="text-truncate">Category</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " href="income/list" title="Danh sách thu nhập">
                                                <span class="tio-circle-outlined nav-indicator-icon"></span>
                                                <span class="text-truncate">List Income</span>
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a class="nav-link" href="transaction/report" title="Báo cáo tổng hợp">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Report</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- End Money Bill  --}}


                        {{-- Pages --}}
                        <li class="nav-item">
                            <small class="nav-subtitle" title="Pages">Pages</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        <li class="nav-item ">
                            <a class="js-nav-tooltip-link nav-link " href="/slide/list" title="Slider"
                               data-placement="left">
                                <i class="tio-dashboard-vs-outlined nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Slider</span>
                            </a>
                        </li>

                        {{-- FAQ  --}}
                        <li class="navbar-vertical-aside-has-menu ">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle " href="javascript:"
                               title="Permission">
                                <i class="tio-parking-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">FAQ</span>
                            </a>

                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                                <li class="nav-item">
                                    <a class="nav-link " href="/role/add" title="Add Role">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Add Role</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="/role/list" title="List Role">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">List Role<span
                                                class="badge badge-info badge-pill ml-1">New</span></span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="/permission/add" title="Data Permission">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Data Permission <span
                                                class="badge badge-info badge-pill ml-1">New</span></span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- End  FAQ  --}}

                        <li class="nav-item ">
                            <a class="js-nav-tooltip-link nav-link " href="/config/list" title="Setting Page"
                               data-placement="left">
                                <i class="tio-dashboard-vs-outlined nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Setting Page</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <div class="nav-divider"></div>
                        </li>

                        <li class="nav-item">
                            <small class="nav-subtitle" title="Documentation">Log Action</small>
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>


                        {{-- Trashed --}}
                        <li class="navbar-vertical-aside-has-menu ">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle" href="javascript:"
                               title="Trashed">
                                <i class="tio-remove-from-trash nav-icon"></i>
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Trashed </span>
                            </a>

                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                                <li class="nav-item">
                                    <a class="nav-link " href="trashed/user/list" title="List Trashed User">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">User</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="trashed/app/list" title="List Trashed Application">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Application</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- End Trashed --}}

                        {{-- Logger --}}
                        <li class="navbar-vertical-aside-has-menu ">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle " href="javascript:"
                               title="History Action">
                                <i class="tio-history nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">History Action </span>
                            </a>

                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                                <li class="nav-item">
                                    <a class="nav-link " href="log-viewer" title="Log File">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Log File</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link " href="log/log-action" title="Log Action">
                                        <span class="tio-circle nav-indicator-icon"></span>
                                        <span class="text-truncate">Log Action</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- End Logger --}}

                        <li class="nav-item">
                            <small class="tio-more-horizontal nav-subtitle-replacer"></small>
                        </li>

                        {{-- Front Builder --}}
                        <li class="nav-item nav-footer-item ">
                            <a class="d-none d-md-flex js-hs-unfold-invoker nav-link nav-link-toggle"
                               href="javascript:" data-hs-unfold-options='{
                                                   "target": "#styleSwitcherDropdown",
                                                   "type": "css-animation",
                                                   "animationIn": "fadeInRight",
                                                   "animationOut": "fadeOutRight",
                                                   "hasOverlay": true,
                                                   "smartPositionOff": true
                                                 }'>
                                <i class="tio-tune nav-icon"></i>
                            </a>
                            <a class="d-flex d-md-none nav-link nav-link-toggle" href="javascript:">
                                <i class="tio-tune nav-icon"></i>
                            </a>
                        </li>
                        {{-- End Front Builder --}}

                        {{-- Help --}}
                        <li class="navbar-vertical-aside-has-menu nav-footer-item ">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle " href="javascript:"
                               title="Help">
                                <i class="tio-home-vs-1-outlined nav-icon"></i>
                                <span class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Help</span>
                            </a>

                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="Resources &amp; tutorials">
                                        <i class="tio-book-outlined dropdown-item-icon"></i> Resources &amp; tutorials
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="Keyboard shortcuts">
                                        <i class="tio-command-key dropdown-item-icon"></i> Keyboard shortcuts
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="Connect other apps">
                                        <i class="tio-alt dropdown-item-icon"></i> Connect other apps
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="What's new?">
                                        <i class="tio-gift dropdown-item-icon"></i> What's new?
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="Contact support">
                                        <i class="tio-chat-outlined dropdown-item-icon"></i> Contact support
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- End Help --}}

                        {{-- Language --}}
                        <li class="navbar-vertical-aside-has-menu nav-footer-item ">
                            <a class="js-navbar-vertical-aside-menu-link nav-link nav-link-toggle " href="javascript:"
                               title="Language">
                                <img class="avatar avatar-xss avatar-circle"
                                     src="{{asset('/assets/images/flags/1x1/us.svg')}}"
                                     alt="United States Flag">
                                <span
                                    class="navbar-vertical-aside-mini-mode-hidden-elements text-truncate">Language</span>
                            </a>

                            <ul class="js-navbar-vertical-aside-submenu nav nav-sub">
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="English">
                                        <img class="avatar avatar-xss avatar-circle mr-2"
                                             src="{{asset('/assets/images/flags/1x1/us.svg')}}"
                                             alt="Flag">
                                        English
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#" title="Tiếng Việt">
                                        <img class="avatar avatar-xss avatar-circle mr-2"
                                             src="{{asset('/assets/images/flags/1x1/gb.svg')}}"
                                             alt="Flag">
                                        Tiếng Việt
                                    </a>
                                </li>
                            </ul>
                        </li>
                        {{-- End Language --}}
                    </ul>
                </div>
                {{-- End Content --}}

                {{-- Footer --}}
                <div class="navbar-vertical-footer">
                    <ul class="navbar-vertical-footer-list">
                        <li class="navbar-vertical-footer-list-item">
                            {{-- Unfold --}}
                            <div class="hs-unfold">
                                <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                                   href="javascript:" data-hs-unfold-options='{
                                                      "target": "#styleSwitcherDropdown",
                                                      "type": "css-animation",
                                                      "animationIn": "fadeInRight",
                                                      "animationOut": "fadeOutRight",
                                                      "hasOverlay": true,
                                                      "smartPositionOff": true
                                                    }'>
                                    <i class="tio-tune"></i>
                                </a>
                            </div>
                            {{-- End Unfold --}}
                        </li>

                        <li class="navbar-vertical-footer-list-item">
                            {{-- Other Links --}}
                            <div class="hs-unfold">
                                <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                                   href="javascript:" data-hs-unfold-options='{
                                                        "target": "#otherLinksDropdown",
                                                        "type": "css-animation",
                                                        "animationIn": "slideInDown",
                                                        "hideOnScroll": true
                                                      }'>
                                    <i class="tio-help-outlined"></i>
                                </a>

                                <div id="otherLinksDropdown"
                                     class="hs-unfold-content dropdown-unfold dropdown-menu navbar-vertical-footer-dropdown">
                                    <span class="dropdown-header">Help</span>
                                    <a class="dropdown-item" href="#">
                                        <i class="tio-book-outlined dropdown-item-icon"></i>
                                        <span class="text-truncate pr-2" title="Resources &amp; tutorials">Resources &amp; tutorials</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="tio-command-key dropdown-item-icon"></i>
                                        <span class="text-truncate pr-2"
                                              title="Keyboard shortcuts">Keyboard shortcuts</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="tio-alt dropdown-item-icon"></i>
                                        <span class="text-truncate pr-2"
                                              title="Connect other apps">Connect other apps</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="tio-gift dropdown-item-icon"></i>
                                        <span class="text-truncate pr-2" title="What's new?">What's new?</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <span class="dropdown-header">Contacts</span>
                                    <a class="dropdown-item" href="#">
                                        <i class="tio-chat-outlined dropdown-item-icon"></i>
                                        <span class="text-truncate pr-2" title="Contact support">Contact support</span>
                                    </a>
                                </div>
                            </div>
                            {{-- End Other Links --}}
                        </li>

                        <li class="navbar-vertical-footer-list-item">
                            {{-- Language --}}
                            <div class="hs-unfold">
                                <a class="js-hs-unfold-invoker btn btn-icon btn-ghost-secondary rounded-circle"
                                   href="javascript:" data-hs-unfold-options='{
                                                      "target": "#languageDropdown",
                                                      "type": "css-animation",
                                                      "animationIn": "slideInDown",
                                                      "hideOnScroll": true }'>
                                    <img class="avatar avatar-xss avatar-circle"
                                         src="{{asset('/assets/images/flags/1x1/vn.svg')}}"
                                         alt="United States Flag">
                                </a>

                                <div id="languageDropdown"
                                     class="hs-unfold-content dropdown-unfold dropdown-menu navbar-vertical-footer-dropdown">
                                    <span class="dropdown-header">Select language</span>
                                    <a class="dropdown-item" href="#">
                                        <img class="avatar avatar-xss avatar-circle mr-2"
                                             src="{{asset('/assets/images/flags/1x1/us.svg')}}"
                                             alt="Flag">
                                        <span class="text-truncate pr-2" title="English">English</span>
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <img class="avatar avatar-xss avatar-circle mr-2"
                                             src="{{asset('/assets/images/flags/1x1/vn.svg')}}"
                                             alt="Flag">
                                        <span class="text-truncate pr-2" title="Tiếng Việt">Tiếng Việt</span>
                                    </a>
                                </div>
                            </div>
                            {{-- End Language --}}
                        </li>
                    </ul>
                </div>
                {{-- End Footer --}}
            </div>
        </div>
    </aside>
</div>
