@extends('admin.layout.index')
@section('head')
    <link rel="stylesheet" type="text/css" href="{{asset('/assets/css/custom/money/report.css')}}">
@endsection
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">
            <div class="text-center mb-5">
                <h1 class="page-header-title">BÁO CÁO TÀI CHÍNH </h1>

                <ul class="list-inline list-inline-m-1">
                    <li class="list-inline-item">
                        <i class="tio-city mr-1"></i>
                        <span>Tribe Team</span>
                    </li>

                    <li class="list-inline-item">
                        <i class="tio-poi-outlined mr-1"></i>
                        <a href="#">System,</a>
                        <a href="#">Hà Nội</a>
                    </li>

                    <li class="list-inline-item">
                        <!-- Daterangepicker -->
                        <button id="reportDate" class="btn btn-sm btn-ghost-secondary">
                            <i class="tio-date-range"></i>
                            <span class="js-daterangepicker-predefined-preview ml-1"></span>
                            <input type="hidden" id="typeDate">
                        </button>
                        <!-- End Daterangepicker -->
                    </li>
                </ul>
            </div>
            <!-- End Page Header -->

            <div id="content_report"></div>
        </div>
    </main>
@endsection

@push('scripts')
    <script src="{{asset('/assets/js/chart.min.js')}}"></script>
    <script src="{{asset('/assets/js/custom/money/report.js')}}"></script>
@endpush


