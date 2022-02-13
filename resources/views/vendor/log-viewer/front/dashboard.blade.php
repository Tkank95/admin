@extends('admin.layout.index')

@section('head')
    @include('vendor.log-viewer.front.style')
@endsection

@section('content')
    <div id="content" role="main" class="main">
        <div class="content container-fluid">
            {{-- Page Header --}}
            @include('admin.layout.add.headerPage', [
                     'breadcrumb_list' => 'log-viewer',
                     'breadcrumb' => 'Logs',
                     'page' => 'Dashboard',
                     'pagetitle' => 'System Logs',
                     'linklist' => 'log-viewer/logs',
                     'list' => 'List Log'
                 ])
            {{-- End Page Header --}}

            @include('admin.layout.alert')

            <form>
                <div class="col-lg-12">
                    {{-- Card --}}
                    <div class="card mb-3 mb-lg-5">
                        {{-- Header --}}
                        <div class="card-header">
                            <div class="row justify-content-between align-items-center flex-grow-1">
                                <div class="row">
                                    <div class="col-md-6 col-lg-3">
                                        <canvas id="stats-doughnut-chart" height="300" class="mb-3"></canvas>
                                    </div>
                                    <div class="col-md-6 col-lg-9">
                                        <div class="row mr-1 mt-5">
                                            @foreach($percents as $level => $item)
                                                <div class="col-sm-6 col-md-12 col-lg-4 mb-3">
                                                    <div class="box level-{{ $level }} {{ $item['count'] === 0 ? 'empty' : '' }}">
                                                        <div class="box-icon">
                                                            {!! log_styler()->icon($level) !!}
                                                        </div>

                                                        <div class="box-content">
                                                            <span class="box-text">{{ $item['name'] }}</span>
                                                            <span class="box-number">
                                                                {{ $item['count'] }} @lang('entries') - {!! $item['percent'] !!} %
                                                            </span>
                                                            <div class="progress" style="height: 3px;">
                                                                <div class="progress-bar"
                                                                     style="width: {{ $item['percent'] }}%"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('/assets/js/chart.min.js')}}"></script>
    <script>
        $(function () {
            new Chart(document.getElementById("stats-doughnut-chart"), {
                type: 'doughnut',
                data: {!! $chartData !!},
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });
        });
    </script>
@endsection
