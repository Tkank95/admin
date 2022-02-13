<?php

namespace App\Providers;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Activity::saving(function (Activity $activity) {
//            $activity->properties = $activity->properties->put('agent', [
//                'ip' => Request::ip(),
//                'agent' => Request::header('user-agent')
//                'browser' => \Browser::browserName(),
//                'os' => \Browser::platformName(),
//                'url' => Request::fullUrl(),
//            ]);
//        });
    }
}


