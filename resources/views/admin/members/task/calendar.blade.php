@extends('admin.layout.index')
@section('content')
    <div id="content" role="main" class="main">
        <div class="content container-fluid">

        {{-- Page Header --}}
        {{--            @include('admin.layout.list.headerPageAjax', [--}}
        {{--                        'breadcrumb_list' => 'task/list',--}}
        {{--                        'breadcrumb' => 'Task',--}}
        {{--                        'page' => 'Calendar',--}}
        {{--                        'pagetitle' => 'Lịch làm việc',--}}
        {{--                        'target' => 'taskModal',--}}
        {{--                        'action_title' => 'Create event'--}}
        {{--                    ])--}}
        {{-- End Page Header --}}

        <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-end">
                    <div class="col-sm mb-2 mb-sm-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-no-gutter">
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="javascript:;">Apps</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Calendar</li>
                            </ol>
                        </nav>

                        <h1 class="page-header-title">Calendar</h1>
                    </div>

                    <div class="col-sm-auto">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#addEventToCalendarModal">
                            <i class="tio-add"></i> Create event
                        </button>
                        <!-- End Button trigger modal -->
                    </div>
                </div>
            </div>
            <!-- End Page Header -->

        {{-- Alert --}}
        @include('admin.layout.alert')
        {{-- End Alert --}}

        {{--            <form>--}}
        {{--                @csrf--}}
        {{--                <div class="row">--}}
        {{--                    <div class="col-lg-12">--}}
        {{--                        <div class="card mb-3 mb-lg-5">--}}
        {{--                            --}}{{-- Header --}}
        {{--                            <div class="card-header" id="search-filter">--}}
        {{--                                <div class="row justify-content-between align-items-center flex-grow-1">--}}

        {{--                                    @include('admin.layout.list.headerForm', ['headertitle' => 'List Task','searchholder' => 'tên loại chi phí'])--}}

        {{--                                    --}}{{-- Filters --}}
        {{--                                    <div class="hs-unfold mr-2">--}}
        {{--                                        <a class="js-hs-unfold-invoker btn btn-white" href="javascript:"--}}
        {{--                                           data-hs-unfold-options='{"target": "#FilterDropdown","type": "css-animation",--}}
        {{--                                           "smartPositionOff": true}'><i class="tio-filter-list mr-1"></i>Filter--}}
        {{--                                        </a>--}}

        {{--                                        <div id="FilterDropdown" style="min-width: 25rem;"--}}
        {{--                                             class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right dropdown-card card-dropdown-filter-centered">--}}
        {{--                                            <div class="card">--}}
        {{--                                                <div class="card-header">--}}
        {{--                                                    <h5 class="card-header-title">Filter Task</h5>--}}

        {{--                                                    --}}{{-- Toggle Button--}}
        {{--                                                    <a class="js-hs-unfold-invoker btn btn-icon btn-xs btn-ghost-secondary ml-2"--}}
        {{--                                                       href="javascript:" data-hs-unfold-options='{"target": "#FilterDropdown",--}}
        {{--                                                       "type": "css-animation","smartPositionOff": true}'>--}}
        {{--                                                        <i class="tio-clear tio-lg"></i>--}}
        {{--                                                    </a>--}}
        {{--                                                    --}}{{-- End Toggle Button--}}
        {{--                                                </div>--}}

        {{--                                                <div class="card-body">--}}
        {{--                                                    <form id="filter">--}}
        {{--                                                        <div class="form-row">--}}
        {{--                                                            <div class="col-sm form-group">--}}
        {{--                                                                <small class="text-cap mb-2">Username</small>--}}
        {{--                                                                <select class="js-select2-custom custom-select" size="1"--}}
        {{--                                                                        style="opacity: 0;" name="filter1" id="filter1"--}}
        {{--                                                                        data-hs-select2-options='{"searchInputPlaceholder": "Tìm kiếm username"}'>--}}
        {{--                                                                    <option value="">All username</option>--}}
        {{--                                                                    @foreach($users as $user)--}}
        {{--                                                                        <option--}}
        {{--                                                                            value="{{$user->id}}">{{$user->username}}</option>--}}
        {{--                                                                    @endforeach--}}
        {{--                                                                </select>--}}
        {{--                                                            </div>--}}
        {{--                                                        </div>--}}

        {{--                                                        @include('admin.layout.list.filter.filterDate')--}}

        {{--                                                        <div class="form-row">--}}
        {{--                                                            <div class="col-sm form-group">--}}
        {{--                                                                <small class="text-cap mb-2">Due Date</small>--}}
        {{--                                                                <div--}}
        {{--                                                                    class="js-flatpickr flatpickr-custom input-group input-group-merge"--}}
        {{--                                                                    id="dateDue" data-hs-flatpickr-options='{"appendTo": "#dateDue",--}}
        {{--                                                                     "dateFormat": "Y-m-d","wrap": true}'>--}}
        {{--                                                                    <div class="input-group-prepend" data-toggle="">--}}
        {{--                                                                        <div class="input-group-text">--}}
        {{--                                                                            <i class="tio-calendar-month"></i>--}}
        {{--                                                                        </div>--}}
        {{--                                                                    </div>--}}

        {{--                                                                    <input type="text" id="filter3" name="filter3"--}}
        {{--                                                                           class="flatpickr-custom-form-control form-control"--}}
        {{--                                                                           placeholder="Ngày xong"--}}
        {{--                                                                           data-input="" value="{{old('filter3')}}">--}}
        {{--                                                                </div>--}}
        {{--                                                            </div>--}}

        {{--                                                            <div class="col-sm form-group">--}}
        {{--                                                                <small class="text-cap mb-2">Status</small>--}}
        {{--                                                                <select--}}
        {{--                                                                    class="js-select2-custom js-datatable-filter custom-select"--}}
        {{--                                                                    size="1" style="opacity: 0;" id="filter2"--}}
        {{--                                                                    name="filter2"--}}
        {{--                                                                    data-hs-select2-options='{"minimumResultsForSearch": "Infinity"}'>--}}
        {{--                                                                    <option value="">All status</option>--}}
        {{--                                                                    <option value="1"--}}
        {{--                                                                            data-option-template='<span class="legend-indicator bg-info"></span>Open'>--}}
        {{--                                                                        Open--}}
        {{--                                                                    </option>--}}
        {{--                                                                    <option value="3"--}}
        {{--                                                                            data-option-template='<span class="legend-indicator bg-danger"></span>Closed'>--}}
        {{--                                                                        Closed--}}
        {{--                                                                    </option>--}}
        {{--                                                                    <option value="2"--}}
        {{--                                                                            data-option-template='<span class="legend-indicator bg-primary"></span>In progress'>--}}
        {{--                                                                        In progress--}}
        {{--                                                                    </option>--}}
        {{--                                                                </select>--}}
        {{--                                                            </div>--}}
        {{--                                                        </div>--}}

        {{--                                                        @include('admin.layout.list.filter.actionApply')--}}
        {{--                                                    </form>--}}
        {{--                                                </div>--}}
        {{--                                            </div>--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}
        {{--                                    --}}{{-- End Filters --}}

        {{--                                    --}}{{-- Unfold Columns --}}
        {{--                                    <div class="hs-unfold">--}}
        {{--                                        <a class="js-hs-unfold-invoker btn btn-white" href="javascript:"--}}
        {{--                                           data-hs-unfold-options='{"target": "#showHideDropdown", "type": "css-animation"}'>--}}
        {{--                                            <i class="tio-table mr-1"></i> Columns--}}
        {{--                                        </a>--}}

        {{--                                        <div id="showHideDropdown" style="width: 15rem;"--}}
        {{--                                             class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-right dropdown-card">--}}
        {{--                                            <div class="card card-sm">--}}
        {{--                                                <div class="card-body">--}}
        {{--                                                    @include('admin.layout.list.column.column', [--}}
        {{--                                                                     'col2' => 'Username',--}}
        {{--                                                                     'col3' => 'Thẻ nhiệm vụ',--}}
        {{--                                                                     'col4' => 'Tên nhiệm vụ',--}}
        {{--                                                                     'col5' => 'Due Date',--}}
        {{--                                                                     'col6' => 'Trạng thái',--}}
        {{--                                                                     'col7' => 'Tệp đính kèm',--}}
        {{--                                                                     'col8' => 'Ghi chú',--}}
        {{--                                                                     'col9' => 'Create_at',--}}
        {{--                                                                     'col10' => 'Action'--}}
        {{--                                                     ])--}}
        {{--                                                </div>--}}
        {{--                                            </div>--}}
        {{--                                        </div>--}}
        {{--                                    </div>--}}
        {{--                                    --}}{{-- End Unfold Columns --}}
        {{--                                </div>--}}
        {{--                            </div>--}}
        {{--                            --}}{{-- End Header --}}

        {{--                            --}}{{-- Table --}}
        {{--                            <div class="table-responsive datatable-custom ">--}}
        {{--                                {{$dataTable->table()}}--}}
        {{--                            </div>--}}
        {{--                            --}}{{-- End Table --}}

        {{--                            --}}{{-- Footer --}}
        {{--                            @include('admin.layout.list.tableFooter10')--}}
        {{--                            --}}{{-- End Footer --}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </form>--}}

        <!-- Custom Header -->
            <div class="row align-items-sm-center mb-4">
                <div class="col-lg-5 mb-2 mb-lg-0">
                    <div class="d-flex align-items-center">
                        <button type="button" class="btn btn-white mr-3" data-toggle="tooltip" data-placement="top"
                                title="" data-fc-today="">Today
                        </button>

                        <button type="button"
                                class="btn btn-icon btn-sm btn-ghost-secondary btn-no-focus rounded-circle mr-1"
                                data-fc-prev-month="" data-toggle="tooltip" data-placement="top" title="Previous month">
                            <i class="tio-chevron-left"></i>
                        </button>
                        <button type="button"
                                class="btn btn-icon btn-sm btn-ghost-secondary btn-no-focus rounded-circle ml-1"
                                data-fc-next-month="" data-toggle="tooltip" data-placement="top" title="Next month">
                            <i class="tio-chevron-right"></i>
                        </button>

                        <div class="ml-3">
                            <h4 class="h3 mb-0" data-fc-title=""></h4>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="d-sm-flex align-items-sm-center">
                        <!-- Input Group -->
                        <div class="input-group input-group-merge mr-2 mb-2 mb-sm-0">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <i class="tio-search"></i>
                                </div>
                            </div>
                            <input type="text" id="filter-by-title" class="form-control" placeholder="Search by title">
                        </div>
                        <!-- End Input Group -->

                        <!-- Unfold -->
                        <div class="hs-unfold mr-2">
                            <a class="js-hs-unfold-invoker btn btn-white dropdown-toggle" href="javascript:;"
                               data-hs-unfold-options='{
                     "target": "#calendarFilterDropdown",
                     "type": "css-animation"
                   }'>
                                <i class="tio-filter-list mr-1"></i> Filter
                            </a>

                            <div id="calendarFilterDropdown"
                                 class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-card"
                                 style="min-width: 15rem;">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-body">
                                        <small class="card-subtitle">My calendars</small>

                                        <!-- Custom Checkbox -->
                                        <div class="custom-control custom-checkbox mb-2" data-filter="">
                                            <input type="checkbox" id="calendarPersonalCheck"
                                                   class="custom-control-input"
                                                   value="fullcalendar-custom-event-hs-team" checked="">
                                            <label class="custom-control-label" for="calendarPersonalCheck">HS
                                                Team</label>
                                        </div>
                                        <!-- End Custom Checkbox -->

                                        <!-- Custom Checkbox -->
                                        <div class="custom-control custom-checkbox checkbox-outline-danger mb-2"
                                             data-filter="">
                                            <input type="checkbox" id="calendarRemindersCheck"
                                                   class="custom-control-input indeterminate-checkbox"
                                                   value="fullcalendar-custom-event-reminders" checked="">
                                            <label class="custom-control-label"
                                                   for="calendarRemindersCheck">Reminders</label>
                                        </div>
                                        <!-- End Custom Checkbox -->

                                        <!-- Custom Checkbox -->
                                        <div class="custom-control custom-checkbox checkbox-outline-warning"
                                             data-filter="">
                                            <input type="checkbox" id="calendarTasksCheck" class="custom-control-input"
                                                   value="fullcalendar-custom-event-tasks" checked="">
                                            <label class="custom-control-label" for="calendarTasksCheck">Tasks</label>
                                        </div>
                                        <!-- End Custom Checkbox -->
                                    </div>

                                    <hr class="my-0">

                                    <div class="card-body">
                                        <small class="card-subtitle">Other calendars</small>

                                        <!-- Custom Checkbox -->
                                        <div class="custom-control custom-checkbox checkbox-outline-success"
                                             data-filter="">
                                            <input type="checkbox" id="calendarHolidaysCheck"
                                                   class="custom-control-input"
                                                   value="fullcalendar-custom-event-holidays" checked="">
                                            <label class="custom-control-label"
                                                   for="calendarHolidaysCheck">Holidays</label>
                                        </div>
                                        <!-- End Custom Checkbox -->
                                    </div>
                                </div>
                                <!-- End Card -->
                            </div>
                        </div>
                        <!-- End Unfold -->

                        <!-- Unfold -->
                        <div class="hs-unfold mr-2">
                            <a class="js-hs-unfold-invoker btn btn-white dropdown-toggle" href="javascript:;"
                               data-hs-unfold-options='{
                     "target": "#calendarEventsDropdown",
                     "type": "css-animation"
                   }'>
                                <i class="tio-event mr-1"></i> Events
                            </a>

                            <div id="calendarEventsDropdown"
                                 class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right dropdown-card"
                                 style="min-width: 15rem;">
                                <!-- Card -->
                                <div class="card">
                                    <div class="card-body card-body-height">
                                        <small class="card-subtitle">Drag these onto the calendar:</small>

                                        <!-- External Events -->
                                        <div id="external-events" class="fullcalendar-custom">
                                            <!-- Event -->
                                            <div
                                                class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event fc-daygrid-inline-block-event fullcalendar-custom-event-hs-team'
                                                data-event='{
                               "title": "Open a new task on Jira",
                               "image": "./assets/svg/brands/jira.svg",
                               "className": "",
                               "forceEvent": true
                             }'>
                                                <div class='fc-event-title'>
                                                    <div class='d-flex align-items-center'>
                                                        <img class="avatar avatar-xss mr-2"
                                                             src="assets\svg\brands\jira.svg" alt="Image Description">
                                                        <span>Open a new task on Jira</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Event -->

                                            <!-- Event -->
                                            <div
                                                class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event fc-daygrid-inline-block-event fullcalendar-custom-event-reminders'
                                                data-event='{
                               "title": "Send weekly invoice to John",
                               "image": "./assets/svg/brands/excel.svg",
                               "className": "fc-event-success",
                               "forceEvent": true
                             }'>
                                                <div class='fc-event-title'>
                                                    <div class='d-flex align-items-center'>
                                                        <img class="avatar avatar-xss mr-2"
                                                             src="assets\svg\brands\excel.svg" alt="Image Description">
                                                        <span>Send weekly invoice to John</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Event -->

                                            <!-- Event -->
                                            <div
                                                class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event fc-daygrid-inline-block-event fullcalendar-custom-event-hs-team'
                                                data-event='{
                               "title": "Shoot a message to Christina on Slack",
                               "image": "./assets/svg/brands/slack.svg",
                               "className": "",
                               "forceEvent": true
                             }'>
                                                <div class='fc-event-title'>
                                                    <div class='d-flex align-items-center'>
                                                        <img class="avatar avatar-xss mr-2"
                                                             src="assets\svg\brands\slack.svg" alt="Image Description">
                                                        <span>Shoot a message to Christina on Slack</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Event -->

                                            <!-- Event -->
                                            <div
                                                class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event fc-daygrid-inline-block-event fullcalendar-custom-event-tasks'
                                                data-event='{
                               "title": "First team timeline",
                               "image": "",
                               "className": "fc-event-success",
                               "forceEvent": true
                             }'>
                                                <div class='fc-event-title'>
                                                    <div class='d-flex align-items-center'>
                              <span class="avatar avatar-xss avatar-info avatar-circle mr-2">
                                <span class="avatar-initials">F</span>
                              </span>
                                                        <span>First team timeline</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Event -->

                                            <!-- Event -->
                                            <div
                                                class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event fc-daygrid-inline-block-event fullcalendar-custom-event-reminders'
                                                data-event='{
                               "title": "Download monthly data in DigitalOcean",
                               "image": "./assets/svg/brands/digitalocean.svg",
                               "className": "",
                               "forceEvent": true
                             }'>
                                                <div class='fc-event-title'>
                                                    <div class='d-flex align-items-center'>
                                                        <img class="avatar avatar-xss mr-2"
                                                             src="assets\svg\brands\digitalocean.svg"
                                                             alt="Image Description">
                                                        <span>Download monthly data in DigitalOcean</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Event -->

                                            <!-- Event -->
                                            <div
                                                class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event fc-daygrid-inline-block-event fullcalendar-custom-event-tasks'
                                                data-event='{
                               "title": "Hire a Figma designer",
                               "image": "./assets/svg/brands/figma.svg",
                               "className": "",
                               "forceEvent": true
                             }'>
                                                <div class='fc-event-title'>
                                                    <div class='d-flex align-items-center'>
                                                        <img class="avatar avatar-xss mr-2"
                                                             src="assets\svg\brands\figma.svg" alt="Image Description">
                                                        <span>Hire a Figma designer</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Event -->

                                            <!-- Event -->
                                            <div
                                                class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event fc-daygrid-inline-block-event fullcalendar-custom-event-hs-team'
                                                data-event='{
                               "title": "Mobile App rework for (Pixeel)",
                               "image": "",
                               "className": "",
                               "forceEvent": true
                             }'>
                                                <div class='fc-event-title'>
                                                    <div class='d-flex align-items-center'>
                              <span class="avatar avatar-xss avatar-primary avatar-circle mr-2">
                                <span class="avatar-initials">M</span>
                              </span>
                                                        <span>Mobile App rework for (Pixeel)</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Event -->
                                        </div>
                                        <!-- End External Events -->
                                    </div>
                                </div>
                                <!-- End Card -->
                            </div>
                        </div>
                        <!-- End Unfold -->

                        <!-- Select2 -->
                        <select class="js-select2-custom custom-select" size="1" style="opacity: 0;"
                                data-fc-grid-view="" data-hs-select2-options='{
                        "minimumResultsForSearch": "Infinity",
                        "width": "100px"
                      }'>
                            <option value="dayGridMonth">Month</option>
                            <option value="timeGridWeek">Week</option>
                            <option value="timeGridDay">Day</option>
                            <option value="listWeek">List</option>
                        </select>
                        <!-- End Select2 -->
                    </div>
                </div>
            </div>
            <!-- End Custom Header -->

            <!-- Fullcalendar -->
            <div id="js-fullcalendar" class="fullcalendar-custom"></div>
            <!-- End Fullcalendar -->

            <!-- Modal -->
            <div class="modal fade" id="addEventToCalendarModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <!-- Header -->
                        <div class="modal-close">
                            <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary" data-dismiss="modal"
                                    aria-label="Close">
                                <i class="tio-clear tio-lg"></i>
                            </button>
                        </div>
                        <!-- End Header -->

                        <!-- Body -->
                        <div class="modal-body">
                            <!-- Media -->
                            <div class="media">
                                <label for="eventTitleLabel" class="sr-only">Title</label>

                                <textarea id="eventTitleLabel" class="form-control form-control-title"
                                          placeholder="Add title"></textarea>
                            </div>
                            <!-- End Media -->

                            <div class="row form-group">
                                <div class="col-sm-3 mb-2 mb-sm-0">
                                    <div class="media align-items-center mt-2">
                                        <i class="tio-format-points nav-icon"></i>

                                        <div class="media-body">Event type</div>
                                    </div>
                                </div>

                                <div class="col-sm">
                                    <!-- Select -->
                                    <select class="js-select2-custom custom-select" size="1"
                                            style="opacity: 0;" name="tag_id" id="eventCategoryLabel"
                                            data-hs-select2-options='{
                                                    "searchInputPlaceholder": "Tìm kiếm thẻ nhiệm vụ",
                                                    "placeholder": "Select event color"}'>
                                        <option value="">All Task Tags</option>
                                        @foreach($category as $cate)
                                            <option value="{{$cate->id}}">{{$cate->name}}</option>
                                        @endforeach
                                    </select>
                                    <!-- End Select -->
                                </div>
                            </div>
                            <!-- End Row -->

                            <div class="row form-group">
                                <div class="col-sm-3 mb-2 mb-sm-0">
                                    <div class="media align-items-center mt-2">
                                        <i class="tio-event nav-icon"></i>

                                        <div class="media-body">Deadline</div>
                                    </div>
                                </div>

                                <div class="col-sm row">
                                    <div class="col-sm-8">
                                        <label for="eventDateRangeLabel" class="sr-only">Date</label>
                                        <input type="text" id="eventDateRangeLabel"
                                               class="js-flatpickr form-control flatpickr-custom"
                                               placeholder="Select dates" data-hs-flatpickr-options='{
                                             "dateFormat": "Y/m/d H:i",
                                             "enableTime": true,
                                             "time_24hr": true,
                                             "mode": "range",
                                             "minDate": "12/01/2020"
                                        }'>
                                    </div>

                                    <div class="col-sm-4">

                                        <!-- Select -->
                                        <select class="js-select2-custom custom-select" id="eventRepeatLabel"
                                                data-hs-select2-options='{"minimumResultsForSearch": "Infinity"}'>
                                            <option value="" selected>Select Repeat</option>
                                            <option value="everyday">Everyday</option>
                                            <option value="weekdays">Weekdays</option>
                                            <option value="never">Never</option>
                                        </select>
                                        <!-- End Select -->
                                    </div>

                                </div>
                            </div>
                            <!-- End Row -->

                            <div class="row form-group">
                                <div class="col-sm-3 mb-2 mb-sm-0">
                                    <div class="media align-items-center mt-2">
                                        <i class="tio-group-senior nav-icon"></i>

                                        <div class="media-body">Guests</div>
                                    </div>
                                </div>

                                <div class="col-sm">
                                    <label for="eventGestsLabel" class="sr-only">Add guests</label>

                                    <!-- Tagify -->
                                    <input class="tagify-form-control form-control" id="eventGestsLabel"
                                           placeholder="Add guests" aria-label="Add guests" data-hs-tagify-options='{
                                         "delimiters": null,
                                         "whitelist": [
                           {
                             "value": "Amanda Harvey",
                             "src": ""
                           },{
                             "value": "David Harrison",
                             "src": "./assets/img/160x160/img3.jpg"
                           }, {
                             "value": "Finch Hoot",
                             "src": "./assets/img/160x160/img5.jpg"
                           }, {
                             "value": "Ella Lauda",
                             "src": "./assets/img/160x160/img9.jpg"
                           }
                         ],
                                   "dropdown": {
                                     "enabled": 0,
                                     "classname": "tagify__dropdown__menu"
                                   }
                                 }'>
                                    <!-- End Tagify -->
                                </div>
                            </div>
                            <!-- End Row -->

                            <div class="row form-group">
                                <div class="col-sm-3 mb-2 mb-sm-0">
                                    <div class="media align-items-center mt-2">
                                        <i class="tio-poi nav-icon"></i>

                                        <div class="media-body">Location</div>
                                    </div>
                                </div>

                                <div class="col-sm">
                                    <label for="eventLocationLabel" class="sr-only">Add location</label>

                                    <input type="text" class="form-control" id="eventLocationLabel"
                                           placeholder="Add location" aria-label="Add location">
                                </div>
                            </div>
                            <!-- End Row -->

                            <div class="row form-group">
                                <div class="col-sm-3 mb-2 mb-sm-0">
                                    <div class="media align-items-center mt-2">
                                        <i class="tio-text-left nav-icon"></i>

                                        <div class="media-body">Description</div>
                                    </div>
                                </div>

                                <div class="col-sm">
                                    <label for="eventDescriptionLabel" class="sr-only">Add description</label>

                                    <textarea id="eventDescriptionLabel" class="form-control"
                                              placeholder="Add description"></textarea>
                                </div>
                            </div>
                            <!-- End Row -->

                            <div class="row">
                                <div class="col-sm-3 mb-2 mb-sm-0">
                                    <div class="media align-items-center mt-2">
                                        <i class="tio-user-big-outlined nav-icon"></i>

                                        <div class="media-body">Created by</div>
                                    </div>
                                </div>

                                <div class="col-sm">
                                    <!-- Media -->
                                    <a class="d-inline-flex align-items-center" href="user-profile.html">
                                        <div class="avatar avatar-sm avatar-circle mr-3">
                                            <img class="avatar-img" src="{{Auth::user()->avatar}}"
                                                 alt="Image Description">
                                        </div>
                                        <div class="media-body">
                                            <span class="h5 text-hover-primary">{{Auth::user()->name}}</span>
                                            <span
                                                class="media align-items-center">{{ (Auth::user()->position) == 1 ? 'Administrator (Admin)' : ($position == 2 ? 'Supermoderator (Smod)' : ($position == 3 ? 'Moderator (Mod)' : ($position == 4 ? 'Agency' :  'User')))}}</span>
                                        </div>
                                    </a>
                                    <!-- End Media -->
                                </div>
                            </div>
                            <!-- End Row -->
                        </div>
                        <!-- End Body -->

                        <!-- Footer -->
                        <div class="modal-footer">
                            <button type="button" id="discardFormt" class="btn btn-white" data-dismiss="modal">Discard
                            </button>
                            <button type="button" id="processEvent" class="btn btn-primary">Create event</button>
                        </div>
                        <!-- End Footer -->
                    </div>
                </div>
            </div>

            {{--            --}}{{-- Add Task Modal --}}
            {{--            <div class="modal fade" id="taskModal" data-backdrop="static" tabindex="-1" role="dialog"--}}
            {{--                 aria-labelledby="taskModalLabel" aria-hidden="true">--}}
            {{--                <div class="modal-dialog modal-lg modal-dialog-centered">--}}
            {{--                    <div class="modal-content">--}}
            {{--                        <form id="addTask" method="post" enctype="multipart/form-data">@csrf--}}
            {{--                            <div class="modal-header">--}}
            {{--                                <h4 class="modal-title" id="modalHeading">Create a new task</h4>--}}
            {{--                                <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary"--}}
            {{--                                        data-dismiss="modal" aria-label="Close">--}}
            {{--                                    <i class="tio-clear tio-lg"></i></button>--}}
            {{--                            </div>--}}
            {{--                            <div class="modal-body">--}}
            {{--                                <div class="form-group required">--}}
            {{--                                    <label for="tag_id" class="input-label">Loại công việc, nhiệm vụ</label>--}}
            {{--                                    <select class="js-select2-custom custom-select" size="1"--}}
            {{--                                            style="opacity: 0;" name="tag_id" id="tag_id"--}}
            {{--                                            data-hs-select2-options='{"searchInputPlaceholder": "Tìm kiếm thẻ nhiệm vụ"}'>--}}
            {{--                                        <option value="">All Task Tags</option>--}}
            {{--                                        @foreach($category as $cate)--}}
            {{--                                            <option value="{{$cate->id}}">{{$cate->name}}</option>--}}
            {{--                                        @endforeach--}}
            {{--                                    </select>--}}
            {{--                                </div>--}}

            {{--                                <div class="form-group required">--}}
            {{--                                    <label for="name" class="input-label">Tên công việc, nhiệm vụ</label>--}}
            {{--                                    <input type="text" class="form-control" name="name" autocomplete="name" required--}}
            {{--                                           value="{{old('name')}}" placeholder="Nhập tên công việc, nhiệm vụ" id="name">--}}
            {{--                                </div>--}}

            {{--                                <div class="row">--}}
            {{--                                    <div class="col-sm-5">--}}
            {{--                                        <div class="form-group required">--}}
            {{--                                            <label for="user_id" class="input-label">Người thực hiện</label>--}}
            {{--                                            <select class="js-select2-custom custom-select" size="1"--}}
            {{--                                                    style="opacity: 0;" name="user_id" id="user_id"--}}
            {{--                                                    data-hs-select2-options='{"searchInputPlaceholder": "Tìm kiếm username"}'>--}}
            {{--                                                <option value="">All username</option>--}}
            {{--                                                @foreach($users as $user)--}}
            {{--                                                    <option value="{{$user->id}}">{{$user->username}}</option>--}}
            {{--                                                @endforeach--}}
            {{--                                            </select>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}

            {{--                                    <div class="col-sm-4">--}}
            {{--                                        <div class="form-group required">--}}
            {{--                                            <label for="due_date" class="input-label">Deadline</label>--}}
            {{--                                            <div class="js-flatpickr flatpickr-custom input-group input-group-merge"--}}
            {{--                                                 id="deadLine" data-hs-flatpickr-options='{"appendTo": "#deadLine",--}}
            {{--                                                    "dateFormat": "Y-m-d H:i:ss","wrap": true, "enableTime": true, "time_24hr": true}'>--}}
            {{--                                                <div class="input-group-prepend" data-toggle="">--}}
            {{--                                                    <div class="input-group-text"><i class="tio-calendar-month"></i>--}}
            {{--                                                    </div>--}}
            {{--                                                </div>--}}

            {{--                                                <input type="text" id="due_date" name="due_date" data-input=""--}}
            {{--                                                       class="flatpickr-custom-form-control form-control" required--}}
            {{--                                                       placeholder="Hạn hoàn thành" value="{{ old('due_date') }}">--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}

            {{--                                    <div class="col-sm-3">--}}
            {{--                                        <div class="form-group required">--}}
            {{--                                            <label for="status" class="input-label">Status</label>--}}
            {{--                                            <select class="js-select2-custom js-datatable-filter custom-select"--}}
            {{--                                                    size="1" style="opacity: 0;" id="status" name="status" required--}}
            {{--                                                    data-hs-select2-options='{"minimumResultsForSearch": "Infinity"}'>--}}
            {{--                                                <option value="1" selected data-option-template='<span class="--}}
            {{--                                                        legend-indicator bg-info"></span>Open'>Open--}}
            {{--                                                </option>--}}
            {{--                                                <option value="3" data-option-template='<span class="legend-indicator--}}
            {{--                                                        bg-danger"></span>Closed'>Closed--}}
            {{--                                                </option>--}}
            {{--                                                <option value="2" data-option-template='<span class="legend-indicator--}}
            {{--                                                        bg-primary"></span>In progress'>In progress--}}
            {{--                                                </option>--}}
            {{--                                            </select>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}

            {{--                                <div class="row">--}}
            {{--                                    <div class="col-sm-5">--}}
            {{--                                        <label for="attachment" class="input-label">Tệp đính kèm--}}
            {{--                                            <i class="tio-help-outlined text-body ml-1" data-toggle="tooltip"--}}
            {{--                                               data-placement="top" title="Chỉ tải lên 1 tệp, nếu nhiều tệp thì nén lại--}}
            {{--                                               rồi tải lên, các tệp được chấp nhận: image,.xlsx,.xls,.pdf,.doc,.docx">--}}
            {{--                                            </i>--}}
            {{--                                        </label>--}}
            {{--                                        <div id="attachFiles" class="js-dropzone dropzone-custom custom-file-boxed">--}}
            {{--                                            <div class="dz-message custom-file-boxed-label">--}}
            {{--                                                <img class="avatar avatar-xl avatar-4by3 mb-3" alt="Tệp đính kèm"--}}
            {{--                                                     src="../assets/svg/illustrations/browse.svg">--}}
            {{--                                                <h6>Drag and drop your file here</h6>--}}
            {{--                                                <p class="mb-2">or</p>--}}
            {{--                                                <span class="btn btn-sm btn-primary">Browse files</span>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                        <input type="hidden" class="upload" id="attachment" name="attachment">--}}
            {{--                                    </div>--}}

            {{--                                    <div class="col-sm-7">--}}
            {{--                                        <div class="form-group">--}}
            {{--                                            <label for="description" class="input-label">Ghi chú</label>--}}
            {{--                                            <textarea class="form-control" id="description" name="description" rows="12"--}}
            {{--                                                      placeholder="Mô tả thông tin chi tiết"--}}
            {{--                                                      value="{{ old('description') }}"></textarea>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                            <div class="modal-footer">--}}
            {{--                                <button type="button" class="btn btn-white" data-dismiss="modal">Huỷ</button>--}}
            {{--                                <button type="submit" class="btn btn-primary">Lưu</button>--}}
            {{--                            </div>--}}
            {{--                        </form>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            --}}{{-- End Add Task Modal --}}

            {{--            --}}{{-- Update Task Modal --}}
            {{--            <div class="modal fade" id="editTaskModal" data-backdrop="static" tabindex="-1" role="dialog"--}}
            {{--                 aria-labelledby="editTaskModalLabel" aria-hidden="true">--}}
            {{--                <div class="modal-dialog modal-lg modal-dialog-centered">--}}
            {{--                    <div class="modal-content">--}}
            {{--                        <form id="editTask" method="post" enctype="multipart/form-data">@csrf--}}
            {{--                            <div class="modal-header">--}}
            {{--                                <h4 class="modal-title" id="modalHeading">Cập nhật chi phí thanh toán</h4>--}}
            {{--                                <button type="button" class="btn btn-xs btn-icon btn-ghost-secondary"--}}
            {{--                                        data-dismiss="modal"--}}
            {{--                                        aria-label="Close"><i class="tio-clear tio-lg"></i></button>--}}
            {{--                            </div>--}}
            {{--                            <div class="modal-body">--}}
            {{--                                <input type="hidden" name="id" id="id">--}}
            {{--                                <div class="form-group required">--}}
            {{--                                    <label for="tag_id" class="input-label">Loại công việc, nhiệm vụ</label>--}}
            {{--                                    <select class="js-select2-custom custom-select" size="1"--}}
            {{--                                            style="opacity: 0;" name="tag_id" id="tag_id1"--}}
            {{--                                            data-hs-select2-options='{"searchInputPlaceholder": "Tìm kiếm thẻ nhiệm vụ"}'>--}}
            {{--                                        <option value="">All Task Tags</option>--}}
            {{--                                        @foreach($category as $cate)--}}
            {{--                                            <option value="{{$cate->id}}">{{$cate->name}}</option>--}}
            {{--                                        @endforeach--}}
            {{--                                    </select>--}}
            {{--                                </div>--}}

            {{--                                <div class="form-group required">--}}
            {{--                                    <label for="name" class="input-label">Tên công việc, nhiệm vụ</label>--}}
            {{--                                    <input type="text" class="form-control" name="name" autocomplete="name" required--}}
            {{--                                           value="{{old('name')}}" placeholder="Nhập tên công việc, nhiệm vụ"--}}
            {{--                                           id="name1">--}}
            {{--                                </div>--}}

            {{--                                <div class="row">--}}
            {{--                                    <div class="col-sm-5">--}}
            {{--                                        <div class="form-group required">--}}
            {{--                                            <label for="user_id" class="input-label">Người thực hiện</label>--}}
            {{--                                            <select class="js-select2-custom custom-select" size="1"--}}
            {{--                                                    style="opacity: 0;" name="user_id" id="user_id1"--}}
            {{--                                                    data-hs-select2-options='{"searchInputPlaceholder": "Tìm kiếm username"}'>--}}
            {{--                                                <option value="">All username</option>--}}
            {{--                                                @foreach($users as $user)--}}
            {{--                                                    <option value="{{$user->id}}">{{$user->username}}</option>--}}
            {{--                                                @endforeach--}}
            {{--                                            </select>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}

            {{--                                    <div class="col-sm-4">--}}
            {{--                                        <div class="form-group required">--}}
            {{--                                            <label for="due_date" class="input-label">Deadline</label>--}}
            {{--                                            <div class="js-flatpickr flatpickr-custom input-group input-group-merge"--}}
            {{--                                                 id="deadLine1" data-hs-flatpickr-options='{"appendTo": "#deadLine1",--}}
            {{--                                                    "dateFormat": "Y-m-d H:i:ss","wrap": true, "enableTime": true, "time_24hr": true}'>--}}
            {{--                                                <div class="input-group-prepend" data-toggle="">--}}
            {{--                                                    <div class="input-group-text"><i class="tio-calendar-month"></i>--}}
            {{--                                                    </div>--}}
            {{--                                                </div>--}}

            {{--                                                <input type="text" id="due_date1" name="due_date" data-input=""--}}
            {{--                                                       class="flatpickr-custom-form-control form-control" required--}}
            {{--                                                       placeholder="Hạn hoàn thành" value="{{ old('due_date') }}">--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}

            {{--                                    <div class="col-sm-3">--}}
            {{--                                        <div class="form-group required">--}}
            {{--                                            <label for="status" class="input-label">Status</label>--}}
            {{--                                            <select class="js-select2-custom js-datatable-filter custom-select"--}}
            {{--                                                    size="1" style="opacity: 0;" id="status1" name="status" required--}}
            {{--                                                    data-hs-select2-options='{"minimumResultsForSearch": "Infinity"}'>--}}
            {{--                                                <option value="1" selected data-option-template='<span class="--}}
            {{--                                                        legend-indicator bg-info"></span>Open'>Open--}}
            {{--                                                </option>--}}
            {{--                                                <option value="3" data-option-template='<span class="legend-indicator--}}
            {{--                                                        bg-danger"></span>Closed'>Closed--}}
            {{--                                                </option>--}}
            {{--                                                <option value="2" data-option-template='<span class="legend-indicator--}}
            {{--                                                        bg-primary"></span>In progress'>In progress--}}
            {{--                                                </option>--}}
            {{--                                            </select>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}

            {{--                                <div class="row">--}}
            {{--                                    <div class="col-sm-5">--}}
            {{--                                        <label for="attachment" class="input-label">Tệp đính kèm--}}
            {{--                                            <i class="tio-help-outlined text-body ml-1" data-toggle="tooltip"--}}
            {{--                                               data-placement="top" title="Chỉ tải lên 1 tệp, nếu nhiều tệp thì nén lại--}}
            {{--                                               rồi tải lên, các tệp được chấp nhận: image,.xlsx,.xls,.pdf,.doc,.docx">--}}
            {{--                                            </i>--}}
            {{--                                        </label>--}}
            {{--                                        <div id="attachFiles1" class="js-dropzone dropzone-custom custom-file-boxed">--}}
            {{--                                            <div class="dz-message custom-file-boxed-label">--}}
            {{--                                                <img class="avatar avatar-xl avatar-4by3 mb-3" alt="Tệp đính kèm"--}}
            {{--                                                     src="../assets/svg/illustrations/browse.svg">--}}
            {{--                                                <h6>Drag and drop your file here</h6>--}}
            {{--                                                <p class="mb-2">or</p>--}}
            {{--                                                <span class="btn btn-sm btn-primary">Browse files</span>--}}
            {{--                                            </div>--}}
            {{--                                        </div>--}}
            {{--                                        <div id="showAttachFiles"--}}
            {{--                                             class="js-dropzone dropzone-custom custom-file-boxed"--}}
            {{--                                             style="display: none"></div>--}}
            {{--                                        <input type="hidden" class="upload1" id="attachment1" name="attachment">--}}
            {{--                                    </div>--}}

            {{--                                    <div class="col-sm-7">--}}
            {{--                                        <div class="form-group">--}}
            {{--                                            <label for="description" class="input-label">Ghi chú</label>--}}
            {{--                                            <textarea class="form-control" id="description1" name="description"--}}
            {{--                                                      rows="12" placeholder="Mô tả thông tin chi tiết"--}}
            {{--                                                      value="{{ old('description') }}"></textarea>--}}
            {{--                                        </div>--}}
            {{--                                    </div>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}

            {{--                            <div class="modal-footer">--}}
            {{--                                <div class="col-sm ">--}}
            {{--                                    <a class="d-inline-flex align-items-center" href="user-profile.html">--}}
            {{--                                        <div class="avatar avatar-sm avatar-circle mr-2">--}}
            {{--                                            <img class="avatar-img" id="created_avatar" alt="Avatar" src="">--}}
            {{--                                        </div>--}}
            {{--                                        <div class="media-body">--}}
            {{--                                            <span class="h5 text-hover-primary" id="created_name"></span>--}}
            {{--                                            <span class="media align-items-center" id="update_at"></span>--}}
            {{--                                        </div>--}}
            {{--                                    </a>--}}
            {{--                                </div>--}}

            {{--                                <button type="button" class="btn btn-white" data-dismiss="modal">Huỷ</button>--}}
            {{--                                <button type="submit" class="btn btn-primary">Cập nhật</button>--}}
            {{--                            </div>--}}
            {{--                        </form>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            --}}{{-- End Update Task Modal --}}
        </div>
    </div>
@endsection

@push('scripts')
    {{--    <script src="{{asset('/assets/js/action.js')}}"></script>--}}
    <script src="{{asset('/assets/js/custom/members/task/task.js')}}"></script>
@endpush
