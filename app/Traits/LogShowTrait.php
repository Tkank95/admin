<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;
use App\Traits\Devices;

trait LogShowTrait
{
    use Devices;

    public function logShow($name, $data)
    {
        activity($name)
            ->withProperty('show', $data)
            ->tap(function (Activity $activity) {
                $activity->causer_type = Str::title($this->name);
                $activity->subject_type = request()->fullUrl();
                $activity->ip = request()->ip();
                $activity->agent = $this->device();
            })
            ->log('Viewer Detail');
    }
}
