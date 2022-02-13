<div class="page-header">
    <div class="row align-items-center">
        <div class="col-sm mb-2 mb-sm-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-no-gutter">
                    <li class="breadcrumb-item"><a class="breadcrumb-link"
                                                   href="{{ $breadcrumb_list }}">{{ $breadcrumb }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $page }}</li>
                </ol>
            </nav>
            <h1 class="page-header-title">{{ $pagetitle }}</h1>
        </div>

        <div class="col-auto">
            <a class="btn btn-primary" href="{{$linklist}}">
                <i class="tio-city mr-1"></i> {{ $list }}
            </a>
        </div>
    </div>
</div>
