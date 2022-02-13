<?php

namespace App\Listeners;

use App\Traits\Devices;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Spatie\Activitylog\Models\Activity;

class LoginSuccessfull
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
    public function handle(Login $event)
    {
        $result = [
            'name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'username' => Auth::user()->username,
            'login at' => Carbon::now()->format('Y-m-d H:i:s')
        ];

        activity('login')
            ->by($event->user)
            ->withProperty('success', $result)
            ->tap(function (Activity $activity) {
                $activity->causer_type = 'User';
                $activity->subject_type = Request::fullUrl();
                $activity->ip = Request::ip();
                $activity->agent = $this->device();
            })
            ->log('Success');

    }
}
