{{-- Welcome Message Modal --}}
<div class="modal fade" id="welcomeMessageModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      {{-- Header --}}
      <div class="modal-close">
        <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary" data-dismiss="modal" aria-label="Close">
          <i class="tio-clear tio-lg"></i>
        </button>
      </div>
      {{-- End Header --}}

      {{-- Body --}}
      <div class="modal-body p-sm-5">
        <div class="text-center">
          <div class="w-75 w-sm-50 mx-auto mb-4">
            <img class="img-fluid" src="{{asset('/assets/svg/illustrations/graphs.svg')}}" alt="Image Description">
          </div>

          <h4 class="h1">Welcome to Front</h4>

          <p>We're happy to see you in our community.</p>
        </div>
      </div>
      {{-- End Body --}}

      {{-- Footer --}}
      <div class="modal-footer d-block text-center py-sm-5">
        <small class="text-cap mb-4">Trusted by the world's best teams</small>

        <div class="w-85 mx-auto">
          <div class="row justify-content-between">
            <div class="col">
              <img class="img-fluid ie-welcome-brands" src="{{asset('/assets/svg/brands/gitlab-gray.svg')}}" alt="Image Description">
            </div>
            <div class="col">
              <img class="img-fluid ie-welcome-brands" src="{{asset('/assets/svg/brands/fitbit-gray.svg')}}" alt="Image Description">
            </div>
            <div class="col">
              <img class="img-fluid ie-welcome-brands" src="{{asset('/assets/svg/brands/flow-xo-gray.svg')}}" alt="Image Description">
            </div>
            <div class="col">
              <img class="img-fluid ie-welcome-brands" src="{{asset('/assets/svg/brands/layar-gray.svg')}}" alt="Image Description">
            </div>
          </div>
        </div>
      </div>
      {{-- End Footer --}}
    </div>
  </div>
</div>
{{-- End Welcome Message Modal --}}

{{-- Create a new user Modal --}}
<div class="modal fade" id="inviteUserModal" tabindex="-1" role="dialog" aria-labelledby="inviteUserModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <form class="modal-content">
      {{-- Header --}}
      <div class="modal-header">
        <h4 id="inviteUserModalTitle" class="modal-title">Invite users</h4>

        <button type="button" class="btn btn-icon btn-sm btn-ghost-secondary" data-dismiss="modal" aria-label="Close">
          <i class="tio-clear tio-lg"></i>
        </button>
      </div>
      {{-- End Header --}}

      {{-- Body --}}
      <div class="modal-body">
        {{-- Form Group --}}
        <div class="form-group">
          <div class="input-group input-group-merge mb-2 mb-sm-0">
            <div class="input-group-prepend" id="fullName">
              <span class="input-group-text">
                <i class="tio-search"></i>
              </span>
            </div>

            <input type="text" class="form-control" name="fullName" placeholder="Search name or emails" aria-label="Search name or emails" aria-describedby="fullName">

            <div class="input-group-append input-group-append-last-sm-down-none">
              {{-- Select --}}
              <div id="permissionSelect" class="select2-custom select2-custom-right">
                <select class="js-select2-custom custom-select" size="1" style="opacity: 0;" data-hs-select2-options='{
                  "dropdownParent": "#permissionSelect",
                  "minimumResultsForSearch": "Infinity",
                  "dropdownAutoWidth": true,
                  "dropdownWidth": "11rem"
                }'>
                <option value="guest" selected="">Guest</option>
                <option value="can edit">Can edit</option>
                <option value="can comment">Can comment</option>
                <option value="full access">Full access</option>
              </select>
            </div>
            {{-- End Select --}}

            <a class="btn btn-primary d-none d-sm-block" href="javascript:;">Invite</a>
          </div>
        </div>

        <a class="btn btn-block btn-primary d-sm-none" href="javascript:;">Invite</a>
      </div>
      {{-- End Form Group --}}

      <div class="form-row">
        <h5 class="col modal-title">Invite users</h5>

        <div class="col-auto">
          <a class="d-flex align-items-center font-size-sm text-body" href="#">
            <img class="avatar avatar-xss mr-2" src="{{asset('/assets/svg/brands/gmail.svg')}}" alt="Image Description">
            Import contacts
          </a>
        </div>
      </div>

      <hr class="mt-2">

      <ul class="list-unstyled list-unstyled-py-4">
        {{-- List Group Item --}}
        <li>
          <div class="media">
            <div class="avatar avatar-sm avatar-circle mr-3">
              <img class="avatar-img" src="{{asset('/assets/images/160x160/img10.jpg')}}" alt="Image Description">
            </div>

            <div class="media-body">
              <div class="row align-items-center">
                <div class="col-sm">
                  <h5 class="text-body mb-0">Amanda Harvey <i class="tio-verified text-primary" data-toggle="tooltip" data-placement="top" title="Top endorsed"></i></h5>
                  <span class="d-block font-size-sm">amanda@example.com</span>
                </div>

                <div class="col-sm">
                  {{-- Select --}}
                  <div id="inviteUserSelect1" class="select2-custom select2-custom-sm-right d-sm-flex justify-content-sm-end">
                    <select class="js-select2-custom custom-select-sm" size="1" style="opacity: 0;" data-hs-select2-options='{
                      "dropdownParent": "#inviteUserSelect1",
                      "minimumResultsForSearch": "Infinity",
                      "customClass": "custom-select custom-select-sm custom-select-borderless pl-0",
                      "dropdownAutoWidth": true,
                      "width": true
                    }'>
                    <option value="guest" selected="">Guest</option>
                    <option value="can edit">Can edit</option>
                    <option value="can comment">Can comment</option>
                    <option value="full access">Full access</option>
                    <option value="remove" data-option-template='<span class="text-danger">Remove</span>'>Remove</option>
                  </select>
                </div>
                {{-- End Select --}}
              </div>
            </div>
            {{-- End Row --}}
          </div>
        </div>
      </li>
      {{-- End List Group Item --}}

      {{-- List Group Item --}}
      <li>
        <div class="media">
          <div class="avatar avatar-sm avatar-circle mr-3">
            <img class="avatar-img" src="{{asset('/assets/images/160x160/img3.jpg')}}" alt="Image Description">
          </div>

          <div class="media-body">
            <div class="row align-items-center">
              <div class="col-sm">
                <h5 class="text-body mb-0">David Harrison</h5>
                <span class="d-block font-size-sm">david@example.com</span>
              </div>

              <div class="col-sm">
                {{-- Select --}}
                <div id="inviteUserSelect2" class="select2-custom select2-custom-sm-right d-sm-flex justify-content-sm-end">
                  <select class="js-select2-custom custom-select-sm" size="1" style="opacity: 0;" data-hs-select2-options='{
                    "dropdownParent": "#inviteUserSelect2",
                    "minimumResultsForSearch": "Infinity",
                    "customClass": "custom-select custom-select-sm custom-select-borderless pl-0",
                    "dropdownAutoWidth": true,
                    "width": true
                  }'>
                  <option value="guest" selected="">Guest</option>
                  <option value="can edit">Can edit</option>
                  <option value="can comment">Can comment</option>
                  <option value="full access">Full access</option>
                  <option value="remove" data-option-template='<span class="text-danger">Remove</span>'>Remove</option>
                </select>
              </div>
              {{-- End Select --}}
            </div>
          </div>
          {{-- End Row --}}
        </div>
      </div>
    </li>
    {{-- End List Group Item --}}

    {{-- List Group Item --}}
    <li>
      <div class="media">
        <div class="avatar avatar-sm avatar-circle mr-3">
          <img class="avatar-img" src="{{asset('/assets/images/160x160/img9.jpg')}}" alt="Image Description">
        </div>

        <div class="media-body">
          <div class="row align-items-center">
            <div class="col-sm">
              <h5 class="text-body mb-0">Ella Lauda <i class="tio-verified text-primary" data-toggle="tooltip" data-placement="top" title="Top endorsed"></i></h5>
              <span class="d-block font-size-sm">Markvt@example.com</span>
            </div>

            <div class="col-sm">
              {{-- Select --}}
              <div id="inviteUserSelect4" class="select2-custom select2-custom-sm-right d-sm-flex justify-content-sm-end">
                <select class="js-select2-custom custom-select-sm" size="1" style="opacity: 0;" data-hs-select2-options='{
                  "dropdownParent": "#inviteUserSelect4",
                  "minimumResultsForSearch": "Infinity",
                  "customClass": "custom-select custom-select-sm custom-select-borderless pl-0",
                  "dropdownAutoWidth": true,
                  "width": true
                }'>
                <option value="guest" selected="">Guest</option>
                <option value="can edit">Can edit</option>
                <option value="can comment">Can comment</option>
                <option value="full access">Full access</option>
                <option value="remove" data-option-template='<span class="text-danger">Remove</span>'>Remove</option>
              </select>
            </div>
            {{-- End Select --}}
          </div>
        </div>
        {{-- End Row --}}
      </div>
    </div>
  </li>
  {{-- End List Group Item --}}

  {{-- List Group Item --}}
  <li>
    <div class="media">
      <div class="avatar avatar-sm avatar-soft-dark avatar-circle mr-3">
        <span class="avatar-initials">B</span>
      </div>

      <div class="media-body">
        <div class="row align-items-center">
          <div class="col-sm">
            <h5 class="text-body mb-0">Bob Dean</h5>
            <span class="d-block font-size-sm">bob@example.com</span>
          </div>

          <div class="col-sm">
            {{-- Select --}}
            <div id="inviteUserSelect3" class="select2-custom select2-custom-sm-right d-sm-flex justify-content-sm-end">
              <select class="js-select2-custom custom-select-sm" size="1" style="opacity: 0;" data-hs-select2-options='{
                "dropdownParent": "#inviteUserSelect3",
                "minimumResultsForSearch": "Infinity",
                "customClass": "custom-select custom-select-sm custom-select-borderless pl-0",
                "dropdownAutoWidth": true,
                "width": true
              }'>
              <option value="guest" selected="">Guest</option>
              <option value="can edit">Can edit</option>
              <option value="can comment">Can comment</option>
              <option value="full access">Full access</option>
              <option value="remove" data-option-template='<span class="text-danger">Remove</span>'>Remove</option>
            </select>
          </div>
          {{-- End Select --}}
        </div>
      </div>
      {{-- End Row --}}
    </div>
  </div>
</li>
{{-- End List Group Item --}}
</ul>
</div>
{{-- End Body --}}

{{-- Footer --}}
<div class="modal-footer justify-content-start">
  <div class="row align-items-center flex-grow-1 mx-n2">
    <div class="col-sm-9 mb-2 mb-sm-0">
      <input type="hidden" id="inviteUserPublicClipboard" value="https://themes.getbootstrap.com/product/front-multipurpose-responsive-template/">

      <p class="modal-footer-text">The public share <a href="#">link settings</a>
        <i class="tio-help-outlined" data-toggle="tooltip" data-placement="top" title="The public share link allows people to view the project without giving access to full collaboration features."></i>
      </p>
    </div>

    <div class="col-sm-3 text-sm-right">
      <a class="js-clipboard btn btn-sm btn-white text-nowrap" href="javascript:;" data-toggle="tooltip" data-placement="top" title="Copy to clipboard!" data-hs-clipboard-options='{
        "type": "tooltip",
        "successText": "Copied!",
        "contentTarget": "#inviteUserPublicClipboard",
        "container": "#inviteUserModal"
      }'>
      <i class="tio-link mr-1"></i> Copy link</a>
    </div>
  </div>
</div>
{{-- End Footer --}}
</form>
</div>
</div>
{{-- End Create a new user Modal --}}
