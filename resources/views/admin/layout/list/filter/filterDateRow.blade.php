<div class="form-row">
    <div class="col-sm form-group">
        <small class="text-cap mb-2">Start Date</small>
        <div
            class="js-flatpickr flatpickr-custom input-group input-group-merge"
            id="dateStart" data-hs-flatpickr-options='{"appendTo": "#dateStart",
                                                                     "dateFormat": "Y-m-d","wrap": true}'>
            <div class="input-group-prepend" data-toggle="">
                <div class="input-group-text">
                    <i class="tio-calendar-month"></i>
                </div>
            </div>

            <input type="text" id="start_date" name="start_date"
                   class="flatpickr-custom-form-control form-control"
                   placeholder="Ngày bắt đầu" data-input=""
                   value="{{old('start_date')}}">
        </div>
    </div>
</div>

<div class="form-row">
    <div class="col-sm form-group">
        <small class="text-cap mb-2">End Date</small>
        <div
            class="js-flatpickr flatpickr-custom input-group input-group-merge"
            id="dateEnd" data-hs-flatpickr-options='{"appendTo": "#dateEnd",
                                                                    "dateFormat": "Y-m-d","wrap": true}'>
            <div class="input-group-prepend" data-toggle="">
                <div class="input-group-text">
                    <i class="tio-calendar-month"></i>
                </div>
            </div>

            <input type="text" id="end_date" name="end_date"
                   class="flatpickr-custom-form-control form-control"
                   placeholder="Ngày kết thúc" data-input=""
                   value="{{old('end_date')}}">
        </div>
    </div>
</div>
