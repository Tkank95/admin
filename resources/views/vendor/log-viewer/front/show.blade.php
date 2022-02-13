<?php
/**
 * @var  Arcanedev\LogViewer\Entities\Log $log
 * @var  Illuminate\Pagination\LengthAwarePaginator $entries
 * @var  string|null $query
 */
?>

@extends('admin.layout.index')

@section('head')
    @include('vendor.log-viewer.front.style')
@endsection

@section('content')
    <div id="content" role="main" class="main">
        <div class="content container-fluid">
            {{-- Page Header --}}
            @include('admin.layout.add.headerPage', [
                     'breadcrumb_list' => 'log-viewer/logs',
                     'breadcrumb' => 'Logs',
                     'page' => 'List',
                     'pagetitle' => "Log $log->date",
                     'linklist' => 'log-viewer/logs',
                     'list' => 'List Log'
                 ])
            {{-- End Page Header --}}

            @include('admin.layout.alert')

            <form action="{{ route('log-viewer::logs.search', [$log->date, $level]) }}"
                  method="Get">@csrf
                <div class="row">
                    <div class="col-lg-12">
                        {{-- Card --}}
                        <div class="card mb-3 mb-lg-5">
                            <div class="card-header">
                                <div class="row justify-content-between align-items-center flex-grow-1">
                                    <div class="col-sm mb-3 mb-sm-0">
                                        <h2 class="card-header-title">Log info</h2>
                                    </div>
                                    <div class="col-sm-6 col-md-4 mb-3 mb-sm-0">
                                        <div class="input-group input-group-merge input-group-flush">
                                            <input id="query" name="query" class="form-control"
                                                   value="{{ $query }}" placeholder="Type here to search"
                                                   aria-label="Type here to search">
                                            <div class="input-group-append">
                                                @unless (is_null($query))
                                                    <a href="{{ route('log-viewer::logs.show', [$log->date]) }}"
                                                       class="btn btn-info">
                                                        @lang(':count results', ['count' => $entries->total()])
                                                        <i class="tio-clear"></i>
                                                    </a>
                                                @endunless
                                                <button id="search-btn" class="btn btn-light">
                                                    <i class="tio-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="group-btn pull-right ml-1">

                                        <!-- Toggle -->
                                        <div class="hs-unfold mr-lg-1">
                                            <a class="js-hs-unfold-invoker btn btn-primary" href="javascript:;"
                                               data-hs-unfold-options='{
                                                  "target": "#activitySidebar",
                                                  "type": "css-animation",
                                                  "animationIn": "fadeInRight",
                                                  "animationOut": "fadeOutRight",
                                                  "hasOverlay": true,
                                                  "smartPositionOff": true
                                               }'> Show Detail
                                            </a>
                                        </div>
                                        <!-- End Toggle -->

                                        <!-- Sidebar -->
                                        <div id="activitySidebar"
                                             class="hs-unfold-content sidebar sidebar-bordered sidebar-box-shadow">
                                            <div class="card card-lg sidebar-card sidebar-footer-fixed">
                                                <div class="card-header">
                                                    <h4 class="card-header-title">Detail Log {{$log->date}}</h4>

                                                    <!-- Toggle Button -->
                                                    <a class="js-hs-unfold-invoker btn btn-icon btn-xs btn-ghost-dark ml-2"
                                                       href="javascript:;"
                                                       data-hs-unfold-options='{
                                                          "target": "#activitySidebar",
                                                          "type": "css-animation",
                                                          "animationIn": "fadeInRight",
                                                          "animationOut": "fadeOutRight",
                                                          "hasOverlay": true,
                                                          "smartPositionOff": true
                                                       }'><i class="tio-clear tio-lg"></i>
                                                    </a>
                                                    <!-- End Toggle Button -->
                                                </div>

                                                <!-- Body -->
                                                <div class="card-body sidebar-body sidebar-scrollbar">
                                                    <div class="list-group list-group-flush log-menu">
                                                        @foreach($log->menu() as $levelKey => $item)
                                                            @if ($item['count'] === 0)
                                                                <a class="list-group-item list-group-item-action d-flex justify-content-between align-items-center disabled">
                                                                    <span
                                                                        class="level-name">{!! $item['icon'] !!} {{ $item['name'] }}</span>
                                                                    <span
                                                                        class="text-truncate empty">{{ $item['count'] }}</span>
                                                                </a>
                                                            @else
                                                                <a href="{{ $item['url'] }}"
                                                                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center level-{{ $levelKey }}{{ $level === $levelKey ? ' active' : ''}}">
                                                                    <span
                                                                        class="level-name">{!! $item['icon'] !!} {{ $item['name'] }}</span>
                                                                    <span
                                                                        class="text-truncate badge-level-{{ $levelKey }}">{{ $item['count'] }}</span>
                                                                </a>
                                                            @endif
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <!-- End Body -->
                                            </div>
                                        </div>
                                        <!-- End Sidebar -->
                                        <a href="{{ route('log-viewer::logs.download', [$log->date]) }}"
                                           class="btn btn-success mr-lg-1">
                                            <i class="tio-download-outlined"></i> @lang('Download')
                                        </a>
                                        <a href="#delete-log-modal" class="btn btn-danger mr-lg-3" data-toggle="modal">
                                            <i class="tio-remove-from-trash"></i> @lang('Delete')
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive datatable-custom">
                                <table class="table table-thead-bordered table-nowrap table-align-middle card-table">
                                    <tbody>
                                    <tr>
                                        <td>@lang('File path') :</td>
                                        <td colspan="7">{{ $log->getPath() }}</td>
                                    </tr>
                                    <tr>
                                        <td>@lang('Log entries') :</td>
                                        <td>
                                            <span class="badge badge-primary">{{ $entries->total() }}</span>
                                        </td>
                                        <td>@lang('Size') :</td>
                                        <td>
                                            <span class="badge badge-primary">{{ $log->size() }}</span>
                                        </td>
                                        <td>@lang('Last change') :</td>
                                        <td>
                                            <span class="badge badge-primary">{{ $log->createdAt() }}</span>
                                        </td>
                                        <td>@lang('Last modified') :</td>
                                        <td>
                                            <span class="badge badge-primary">{{ $log->updatedAt() }}</span>
                                        </td>
                                        <td>@lang('Last time access') :</td>
                                        <td>
                                            <span class="badge badge-primary">{{ $log->lastTimeAccess() }}</span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3 mb-lg-5">
                            <div class="table-responsive datatable-custom">
                                <table id="entries" class="table table-thead-bordered table-align-middle card-table">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>@lang('ENV')</th>
                                        <th>@lang('Level')</th>
                                        <th>@lang('Time')</th>
                                        <th>@lang('Header')</th>
                                        <th>@lang('Actions')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($entries as $key => $entry)
                                        <?php /** @var  Arcanedev\LogViewer\Entities\LogEntry $entry */ ?>
                                        <tr>
                                            <td><span class="badge badge-env">{{ $entry->env }}</span></td>
                                            <td><span
                                                    class="badge badge-level-{{ $entry->level }}">{!! $entry->level() !!}</span>
                                            </td>
                                            <td><span
                                                    class="badge badge-secondary">{{ $entry->datetime->format('H:i:s') }}</span>
                                            </td>
                                            <td>{{ $entry->header }}</td>
                                            <td class="text-nowrap">
                                                @if ($entry->hasStack())
                                                    <a class="btn btn-sm btn-outline-primary"
                                                       data-toggle="collapse" href="#log-stack-{{ $key }}"
                                                       aria-expanded="false" aria-controls="log-stack-{{ $key }}">
                                                        @lang('Stack')
                                                    </a>
                                                @endif

                                                @if ($entry->hasContext())
                                                    <a class="btn btn-sm btn-outline-success" data-toggle="collapse"
                                                       href="#log-context-{{ $key }}" aria-expanded="false"
                                                       aria-controls="log-context-{{ $key }}">@lang('Context')
                                                    </a>
                                                @endif
                                            </td>
                                        </tr>
                                        @if ($entry->hasStack() || $entry->hasContext())
                                            <tr>
                                                <td colspan="5" class="stack py-0">
                                                    @if ($entry->hasStack())
                                                        <div class="stack-content collapse" id="log-stack-{{ $key }}">
                                                            {!! $entry->stack() !!}
                                                        </div>
                                                    @endif

                                                    @if ($entry->hasContext())
                                                        <div class="stack-content collapse" id="log-context-{{ $key }}">
                                                            <pre>{{ $entry->context() }}</pre>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                <div class="text-center p-4">
                                                    <img class="mb-3" src="/assets/svg/illustrations/sorry.svg"
                                                         alt="Image Description" style="width: 7rem;">
                                                    <p class="mb-0">No data to show</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @if ($entries->hasPages())
                                <div class="card-footer">
                                    {{-- Pagination --}}
                                    <div
                                        class="row justify-content-center justify-content-sm-between align-items-sm-center">
                                        <div class="col-sm mb-2 mb-sm-0">
                                            <div
                                                class="d-flex justify-content-center justify-content-sm-start align-items-center">
                                                {{ __('Showing :firstItem to :lastItem of :total  Page :current of :last', [
                                                        'firstItem' => $entries->firstItem(),
                                                        'lastItem' => $entries->lastItem(),
                                                        'total' => $entries->total(),
                                                        'current' => $entries->currentPage(),
                                                        'last' => $entries->lastPage()
                                                ]) }}
                                            </div>
                                        </div>

                                        <div class="col-sm-auto">
                                            <div class="d-flex justify-content-center justify-content-sm-end">
                                                {{-- Pagination --}}
                                                {!! $entries->appends(compact('query'))->onEachSide(1)->links('vendor.pagination.custom') !!}
                                            </div>
                                        </div>
                                    </div>
                                    {{-- End Pagination --}}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- DELETE MODAL --}}
    <div id="delete-log-modal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="delete-log-form" action="{{ route('log-viewer::logs.delete') }}" method="POST">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="date" value="{{ $log->date }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Delete log file')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>@lang('Are you sure you want to delete this log file: :date ?', ['date' => $log->date])</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary mr-auto"
                                data-dismiss="modal">@lang('Cancel')</button>
                        <button type="submit" class="btn btn-sm btn-danger"
                                data-loading-text="@lang('Loading')&hellip;">@lang('Delete')</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            var deleteLogModal = $('div#delete-log-modal'),
                deleteLogForm = $('form#delete-log-form'),
                submitBtn = deleteLogForm.find('button[type=submit]');

            deleteLogForm.on('submit', function (event) {
                event.preventDefault();
                submitBtn.button('loading');

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    dataType: 'json',
                    data: $(this).serialize(),
                    success: function (data) {
                        submitBtn.button('reset');
                        if (data.result === 'success') {
                            deleteLogModal.modal('hide');
                            location.replace("{{ route('log-viewer::logs.list') }}");
                        } else {
                            alert('OOPS ! This is a lack of coffee exception !')
                        }
                    },
                    error: function (xhr, textStatus, errorThrown) {
                        alert('AJAX ERROR ! Check the console !');
                        console.error(errorThrown);
                        submitBtn.button('reset');
                    }
                });

                return false;
            });

            @unless (empty(log_styler()->toHighlight()))
            @php
                $htmlHighlight = version_compare(PHP_VERSION, '7.4.0') >= 0 ? join('|', log_styler()->toHighlight()) : join(log_styler()->toHighlight(), '|');
            @endphp

            $('.stack-content').each(function () {
                var $this = $(this);
                var html = $this.html().trim()
                    .replace(/({!! $htmlHighlight !!})/gm, '<strong>$1</strong>');

                $this.html(html);
            });
            @endunless
        });
    </script>
@endsection
