<div class="card-footer" id="load">
    <div
        class="row justify-content-center justify-content-sm-between align-items-sm-center">
        <div class="col-sm mb-2 mb-sm-0">
            <div class="d-flex justify-content-center justify-content-sm-start align-items-center">
                <span class="mr-2">Showing:</span>
                <select id="datatableEntries" class="js-select2-custom" data-hs-select2-options='{"width": true,
                            "minimumResultsForSearch": "Infinity", "dropdownAutoWidth": true,
                            "customClass": "custom-select custom-select-sm custom-select-borderless"}'>
                    <option value="5" selected="">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>

                <span id="showEntries" class="text-secondary mr-2"></span>
                <span class="text-secondary mr-2">of</span>

                {{-- Pagination Quantity --}}
                <span id="datatableWithPaginationInfoTotalQty"></span>
            </div>
        </div>

        <div class="col-sm-auto">
            <div class="d-flex justify-content-center justify-content-sm-end">
                {{-- Pagination --}}
                <nav id="datatablePagination" aria-label="Activity pagination"></nav>
            </div>
        </div>
    </div>
</div>
