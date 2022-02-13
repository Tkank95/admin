{{-- Form Group Status --}}
<div class="form-group required">
    <label for="status" class="input-label">Status</label>
    <div class="input-group input-group-sm-down-break">

        {{-- Custom Radio Status Acitved --}}
        <div class="form-control">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" name="status" id="actived" value="1" {{ ${$value}->status == 1 ? ' checked=""' : '' }}>
                <label class="custom-control-label" for="actived">Actived</label>
            </div>
        </div>
        {{-- End Custom Radio Status Acitve --}}

        {{-- Custom Radio Status Not activated --}}
        <div class="form-control">
            <div class="custom-control custom-radio">
                <input type="radio" class="custom-control-input" name="status" id="notactived" value="0" {{ ${$value}->status == 0 ? ' checked=""' : '' }}>
                <label class="custom-control-label" for="notactived">Not activated</label>
            </div>
        </div>
        {{-- End Custom Radio Not activated --}}
    </div>
</div>
{{-- End Form Group Status --}}
