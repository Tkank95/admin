<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use App\Traits\Devices;

trait LogViewTrait
{
    use Devices;

    public function logView($name, $type)
    {
        activity($name)
            ->tap(function (Activity $activity) {
                $activity->causer_type = Str::title($this->name);
                $activity->subject_type = request()->fullUrl();
                $activity->ip = request()->ip();
                $activity->agent = $this->device();
            })
            ->log('Viewer ' . $type);
    }
}
