<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        Gate::before(function (Authenticatable $user, $ability) {
            if (!$ability) {
                return true;
            }
            if ($ability === 'admin' && $user->is_admin) {
                return true;
            } else if ($ability === 'admin' && !$user->is_admin) {
                return false;
            }
            return true;
        });
    }
}
