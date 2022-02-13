<?php

namespace App\Providers;

use App\Http\View\Composers\AppComposer;
use App\Http\View\Composers\MenuComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;


class ViewServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->singleton(MenuComposer::class);
    }

    public function boot()
    {
        View::composer([
            'admin.layout.sidebarMain',
            'admin.application.*',
            'admin.new_tutorial.add',
            'admin.new_tutorial.edit',
            'admin.apply_job.*',
            'admin.policy.*',
            'admin.live_rule.*',
            'admin.promote.*',
            'admin.data.*'
        ], MenuComposer::class);
    }
}
