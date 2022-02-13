<?php

namespace App\Http\Middleware;

use App\Traits\Devices;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Spatie\Activitylog\Models\Activity;

class CheckBanned
{
    use Devices;

    public function handle(Request $request, Closure $next)
    {

        if (auth()->check() && auth()->user()->banned_until && now()->lessThan(auth()->user()->banned_until)) {
            $banned_hours = now()->diffInHours(auth()->user()->banned_until);

            if ($banned_hours > 720) {
                $message = 'Your account has been suspended. Please contact administrator!';
            } else {
                $message = 'Your account has been suspended for ' . $banned_hours . ' ' . Str::plural('hour', $banned_hours) . '. Please contact administrator';
            }
            Session::flash('error', $message);

            $result = [
                'message' => $message,
                'signin' => Auth::user()->email,
                'name' => Auth::user()->name,
                'username' => Auth::user()->username,
                'band' => date('Y-m-d H:i:s', strtotime(Auth::user()->banned_until)),
                'status' => Auth::user()->status
            ];

            activity('login')
                ->by(Auth::id())
                ->withProperty('error', $result)
                ->tap(function (Activity $activity) {
                    $activity->causer_type = 'User';
                    $activity->subject_type = \Illuminate\Support\Facades\Request::fullUrl();
                    $activity->ip = \Illuminate\Support\Facades\Request::ip();
                    $activity->agent = $this->device();
                })
                ->log('Block');

            auth()->logout();
            return redirect()->route('login');
        }

        if (auth()->check() && auth()->user()->banned_until && now()->greaterThanOrEqualTo(auth()->user()->banned_until)) {
            auth()->user()->fill(['banned_until' => null])->save();
        }

        return $next($request);

    }
}
