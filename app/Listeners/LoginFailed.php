<?php

namespace App\Listeners;

use App\Traits\Devices;
use Illuminate\Auth\Events\Failed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;


class LoginFailed
{
    use Devices;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(Failed $event)
    {
        $event->subject = 'login';
        $event->description = 'Login Failed';
        $value = Request::input();

        $result = [
            'message' => Session::get('error'),
            'signin' => $value['signin'],
            'value' => $value['password'],
            'login failed at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        if ($event->user != null) {
            activity($event->subject)
                ->by($event->user)
                ->withProperty('error', $result)
                ->tap(function (Activity $activity) {
                    $activity->causer_type = 'User';
                    $activity->subject_type = Request::fullUrl();
                    $activity->ip = Request::ip();
                    $activity->agent = $this->device();
                })
                ->log($event->description);
        }

    }
}
