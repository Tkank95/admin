{{-- Banned user Modal --}}
<div class="modal fade" id="bannedUser" tabindex="-1" role="dialog" aria-labelledby="bannedUserTitle"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form class="modal-content" id="banned">
            @csrf
            {{-- Header --}}
            <div class="modal-header">
                <h4 id="bannedUserTitle" class="modal-title">Banned User</h4>
                <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary" data-dismiss="modal"
                        aria-label="Close"><i class="tio-clear tio-lg"></i>
                </button>
            </div>
            {{-- End Header --}}

            <div class="modal-body">
                <hr class="mt-2">
                <ul class="list-unstyled list-unstyled-py-4">
                    {{-- List Group Item --}}
                    <li>
                        <div class="media">
                            <div class="avatar avatar-sm avatar-circle mr-3">
                                <input type="hidden" id="id">
                                <img class="avatar-img" src="" id="avatar" alt="Image Description">
                            </div>

                            <div class="media-body">
                                <div class="row align-items-center">
                                    <div class="col-sm-5">
                                        <h5 class="text-body mb-0" id="name">
                                            <i class="tio-verified text-primary" data-toggle="tooltip"
                                               data-placement="top" title="Top endorsed"></i></h5>
                                        <span class="d-block font-size-sm" id="email"></span>
                                    </div>

                                    <div class="col-sm-4">
                                        <h5 class="text-body mb-0" id="until"></h5>
                                    </div>

                                    <div class="col-sm-3">
                                        <div id="banUserSelect"
                                             class="select2-custom select2-custom-sm-right d-sm-flex justify-content-sm-end">
                                            <select class="js-select2-custom custom-select-sm" size="1" id="banSelect"
                                                    style="opacity: 0;" data-hs-select2-options='{ "dropdownAutoWidth": true,
                                                        "dropdownParent": "#banUserSelect", "minimumResultsForSearch": "Infinity",
                                                        "customClass": "custom-select custom-select-sm custom-select-borderless pl-0",
                                                        "dropdownWidth": "10rem", "width": true}'>
                                                <option value="0" selected
                                                        data-option-template='<span class="text-danger">Unban</span>'>
                                                    No ban
                                                </option>
                                                <option value="1">1 ngày</option>
                                                <option value="7">7 ngày</option>
                                                <option value="30">30 ngày</option>
                                                <option value="3650">10 năm</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    {{-- End List Group Item --}}
                </ul>
            </div>

            {{-- Footer --}}
            <div class="modal-footer justify-content-start">
                <div class="row align-items-center flex-grow-1 mx-n2">
                    <div class="col-sm-12 text-sm-right">
                        <a class="btn btn-outline-primary" data-dismiss="modal" aria-label="Cancel">Cancel</a>
                        <a class="btn btn-primary save">Save</a>
                    </div>
                </div>
            </div>
            {{-- End Footer --}}
        </form>
    </div>
</div>
{{-- End Banned user Modal --}}
