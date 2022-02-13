<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next)
    {
//        if (Auth::user() &&  (Auth::user()->position == 1 || Auth::user()->position == 2 || Auth::user()->position == 3) ) {
//            return $next($request);
//        }
//
//        return redirect()->away('https://www.tribeidol.com');


        // nếu user đã đăng nhập
        if (Auth::check()) {
            $user = Auth::user();
            // nếu level =1,2,3 (admin), status = 1 (actived) thì cho qua.
            if ($user->status == 1 && $user->position < 3  ) {
                return $next($request);
            }

            Auth::logout();
            return redirect()->route('login');
        }
        return redirect()->away('https://www.tribeidol.com');
    }
}
