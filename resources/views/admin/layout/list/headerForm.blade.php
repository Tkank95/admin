<div class="col-sm mb-3 mb-sm-0">
    <h4 class="card-header-title">{{ $headertitle }}</h4>
</div>

{{-- Seach --}}
<div class="col-sm-6 col-md-4 mb-3 mb-sm-0">
    <form>
        @csrf
        <div class="input-group input-group-merge input-group-flush">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="tio-search"></i>
                </div>
            </div>
            <input id="datatableSearch" type="search" class="form-control"
                   placeholder="Search {{$searchholder}}" aria-label="Search {{$searchholder}}">
        </div>
    </form>
</div>
{{-- End Seach --}}

<div class="col-sm-auto mb-3 mb-sm-0">
    {{-- Datatable Info --}}
    <div id="datatableCounterInfo" style="display: none;">
        <div class="d-flex align-items-center">
            <span class="font-size-sm mr-3">
                <span id="datatableCounter">0</span> Selected
            </span>
            <a class="btn btn-sm btn-outline-danger deleteAll" href="javascript:">
                <i class="tio-delete-outlined"></i> Delete
            </a>
        </div>
    </div>
    {{-- End Datatable Info --}}
</div>

{{-- Export --}}
<div class="hs-unfold mr-2">
    <a class="js-hs-unfold-invoker btn btn-white " href="javascript:"
       data-hs-unfold-options='{"target": "#ExportDropdown", "type": "css-animation"}'>
        <i class="tio-download-to mr-1"></i> Export
    </a>

    <div id="ExportDropdown" class="hs-unfold-content dropdown-unfold dropdown-menu dropdown-menu-sm-right">
        <span class="dropdown-header">Options</span>
        <a id="export-copy" class="dropdown-item" href="javascript:">
            <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('/assets/svg/illustrations/copy.svg')}}"
                 alt="Image Description">Copy
        </a>
        <a id="export-print" class="dropdown-item" href="javascript:">
            <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('/assets/svg/illustrations/print.svg')}}"
                 alt="Image Description">Print
        </a>
        <div class="dropdown-divider"></div>
        <span class="dropdown-header">Download options</span>
        <a id="export-excel" class="dropdown-item" href="javascript:">
            <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('/assets/svg/brands/excel.svg')}}"
                 alt="Image Description">Excel
        </a>
        <a id="export-csv" class="dropdown-item" href="javascript:">
            <img class="avatar avatar-xss avatar-4by3 mr-2" alt="Image Description"
                 src="{{asset('/assets/svg/components/placeholder-csv-format.svg')}}">CSV
        </a>
        <a id="export-pdf" class="dropdown-item" href="javascript:">
            <img class="avatar avatar-xss avatar-4by3 mr-2" src="{{asset('/assets/svg/brands/pdf.svg')}}"
                 alt="Image Description">PDF
        </a>
    </div>
</div>
{{-- End Export --}}
