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
        Gate::define('access-manager', function ($user) {
            return $user->role === 'manager';
        });

        Gate::define('access-admin', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('access-director', function ($user) {
            return $user->role === 'director';
        });
    }
}
