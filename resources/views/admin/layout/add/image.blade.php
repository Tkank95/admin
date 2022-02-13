{{-- Form Group Image --}}
<div class="form-group required">
    <label for="{{$name_img}}" class="input-label">{{$label}}
        <i class="tio-help-outlined text-body ml-1" data-toggle="tooltip" data-placement="top" title="{{$tooltip}}">
        </i></label>
    <input type="file" class="form-control {{$class}}" name="{{$name_img}}">

    <div id="image_show" class="text-center mt-lg-4">
        @if (Agent::isMobile())
            <img src="{{asset('assets/svg/illustrations/browse.svg')}}" id="{{$name_img}}" width="300px" height="300px"
                 alt="{{$label}}">
        @else
            <img src="{{asset('assets/svg/illustrations/browse.svg')}}" id="{{$name_img}}" width="370px" height="370px"
                 alt="{{$label}}">
        @endif
    </div>
</div>
{{-- End Form Group Image --}}

