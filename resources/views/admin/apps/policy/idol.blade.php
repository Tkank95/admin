@extends('admin.layout.index')
@section('content')
    <main id="content" role="main" class="main">
        <div class="content container-fluid">
            {{-- Page Header --}}
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-sm mb-2 mb-sm-0">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb breadcrumb-no-gutter">
                                <li class="breadcrumb-item"><a class="breadcrumb-link" href="/app/list">Apps</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Policy</li>
                            </ol>
                        </nav>
                        <h1 class="page-header-title">Chính sách lương Idol: {{ $policyIdol->policyApp->name }}</h1>
                    </div>

                    <div class="col-auto">
                        <a class="btn btn-primary mr-2" href="policy/list"><i class="tio-money mr-1"></i>List Policy</a>
                        <a class="btn btn-warning" href="rule/list"><i class="tio-pin mr-1"></i>List Rule</a>
                    </div>
                </div>
            </div>
            {{-- End Page Header --}}

            @include('admin.layout.alert')

            <div class="row justify-content-lg-center">
                <div class="col-lg-11">
                    {{-- Alert --}}
                    <div class="alert alert-soft-dark mb-5 mb-lg-7" role="alert">
                        <div class="media align-items-center">
                            <img class="avatar avatar-xl mr-3" alt="Image Description"
                                 src="{{asset('/assets/svg/illustrations/yelling-reverse.svg')}}">

                            <div class="media-body">
                                <h3 class="alert-heading mb-1">Attention!</h3>
                                <p class="mb-0">Đọc kỹ chính sách lương Idol {{ $policyIdol->policyApp->name }}.</p>
                            </div>
                        </div>
                    </div>
                    {{-- End Alert --}}

                    {!! $policyIdol->policy_idol !!}
                </div>

                {{-- Go to --}}
                <a class="js-go-to go-to position-fixed" href="javascript:" style="visibility: hidden;"
                   data-hs-go-to-options='{"offsetTop": 700,"position": {"init": {"right": 32},"show": {"bottom": 32},
                        "hide": {"bottom": -32}}}'><i class="tio-chevron-up"></i>
                </a>
                {{-- End Go to --}}
            </div>
        </div>
    </main>
@endsection

@section('js')
    <script src="{{asset('/assets/js/custom/apps/show_content/content.js')}}"></script>
@endsection
