@extends('admin.layout.index')

<?php /** @var  Illuminate\Pagination\LengthAwarePaginator $rows */ ?>

@section('content')
    <div id="content" role="main" class="main">
        <div class="content container-fluid">
            {{-- Page Header --}}
            @include('admin.layout.add.headerPage', [
                     'breadcrumb_list' => 'log-viewer/logs',
                     'breadcrumb' => 'Logs',
                     'page' => 'List',
                     'pagetitle' => 'System Logs',
                     'linklist' => 'log-viewer',
                     'list' => 'Dashboard'
                 ])
            {{-- End Page Header --}}

            @include('admin.layout.alert')

            <form>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-3 mb-lg-5">
                            <div class="table-responsive datatable-custom">
                                <table id="datatable"
                                       class="table table-border table-hover table-thead-bordered table-nowrap table-align-middle card-table">
                                    <thead class="thead-light">
                                    <tr>
                                        @foreach($headers as $key => $header)
                                            <th scope="col"
                                                class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                                                @if ($key == 'date')
                                                    {{ $header }}
                                                @else
                                                    {{ log_styler()->icon($key) }} {{ $header }}
                                                @endif
                                            </th>
                                        @endforeach
                                        <th scope="col" class="text-center">@lang('Actions')</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($rows as $date => $row)
                                        <tr>
                                            @foreach($row as $key => $value)
                                                <td class="{{ $key == 'date' ? 'text-left' : 'text-center' }}">
                                                    @if ($key == 'date')
                                                        {{ $value }}
                                                    @elseif ($value == 0)
                                                        {{ $value }}
                                                    @else
                                                        <a href="{{ route('log-viewer::logs.filter', [$date, $key]) }}">
                                                            {{ $value }}
                                                        </a>
                                                    @endif
                                                </td>
                                            @endforeach
                                            <td class="text-center">
                                                <a href="{{ route('log-viewer::logs.show', [$date]) }}"
                                                   class="btn btn-sm btn-white">
                                                    <i class="tio-visible-outlined"></i>
                                                </a>
                                                <a href="{{ route('log-viewer::logs.download', [$date]) }}"
                                                   class="btn btn-sm btn-success">
                                                    <i class="tio-download-to"></i>
                                                </a>
                                                <a href="#delete-log-modal" class="btn btn-sm btn-danger"
                                                   data-log-date="{{ $date }}">
                                                    <i class="tio-delete"></i>
                                                </a>
                                            </td>
                                        </tr>
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
                            @if ($rows->hasPages())
                                <div class="card-footer">
                                    {{-- Pagination --}}
                                    <div
                                        class="row justify-content-center justify-content-sm-between align-items-sm-center">
                                        <div class="col-sm mb-2 mb-sm-0">
                                            <div
                                                class="d-flex justify-content-center justify-content-sm-start align-items-center">
                                                {{ __('Showing :firstItem to :lastItem of :total  Page :current of :last', [
                                                        'firstItem' => $rows->firstItem(),
                                                        'lastItem' => $rows->lastItem(),
                                                        'total' => $rows->total(),
                                                        'current' => $rows->currentPage(),
                                                        'last' => $rows->lastPage()
                                                ]) }}
                                            </div>
                                        </div>

                                        <div class="col-sm-auto">
                                            <div class="d-flex justify-content-center justify-content-sm-end">
                                                {{-- Pagination --}}
                                                {{ $rows->links('vendor.pagination.custom') }}
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
                <input type="hidden" name="date" value="">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">@lang('Delete log file')</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p></p>
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

            $("a[href='#delete-log-modal']").on('click', function (event) {
                event.preventDefault();
                var date = $(this).data('log-date'),
                    message = "{{ __('Are you sure you want to delete this log file: :date ?') }}";

                deleteLogForm.find('input[name=date]').val(date);
                deleteLogModal.find('.modal-body p').html(message.replace(':date', date));

                deleteLogModal.modal('show');
            });

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
                            location.reload();
                        } else {
                            alert('AJAX ERROR ! Check the console !');
                            console.error(data);
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

            deleteLogModal.on('hidden.bs.modal', function () {
                deleteLogForm.find('input[name=date]').val('');
                deleteLogModal.find('.modal-body p').html('');
            });
        });
    </script>
@endsection
