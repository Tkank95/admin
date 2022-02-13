{{-- Form Group Image --}}
<div class="form-group required">
    <label for="{{$name_img}}_img" class="input-label">{{$label}}
        <i class="tio-help-outlined text-body ml-1" data-toggle="tooltip" data-placement="top" title="{{$tooltip}}">
        </i></label>
    <input type="file" class="form-control {{$class}}" name="{{$name_img}}_img">

    <div id="image_show" class="text-center mt-lg-4 mt-sm-4">
        @if (Agent::isMobile())
            <img src="{{ optional(${$value}->{$relationship})->{$name_img} }}" id="{{$name_img}}" width="300px" height="300px" alt="{{$label}}">
        @else
            <img src="{{ optional(${$value}->{$relationship})->{$name_img} }}" id="{{$name_img}}" width="370px" height="370px" alt="{{$label}}">
        @endif
        <input type="hidden" name="{{$name_img}}" value="{{ optional(${$value}->{$relationship})->{$name_img} }}">
    </div>
</div>
{{-- End Form Group Image --}}
