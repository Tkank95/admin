<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('application-list', 'App\Policies\ApplicationPolicy@view');
        Gate::define('application-add', 'App\Policies\ApplicationPolicy@create');
        Gate::define('application-edit', 'App\Policies\ApplicationPolicy@update');
        Gate::define('application-delete', 'App\Policies\ApplicationPolicy@delete');
    }
}
