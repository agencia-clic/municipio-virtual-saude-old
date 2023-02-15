<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
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

        /* define a admin user role */
        Gate::define('isAdmin', function($user) {
            return $user->level == "a";
        });

        /* define a super admin user role */
        Gate::define('isSuper', function($user) {
            return $user->level == "s";
        });

        /* define a user user role */
        Gate::define('isUser', function($user) {
            return $user->level == "u";
        });

        /* define a passing user role */
        Gate::define('isPassing', function($user) {
            return $user->level == "p";
        });

        /* define belongs units role */
        Gate::define('belongUnit', function($user) {
            return !empty($user->units_current());
        });

        /* roule larvel */
        Gate::define('roles', function($user, ...$role) {
            return ($user->level != "u" || (count(array_intersect($role, auth()->user()->units_current()->roles())) != 0));
        });
    }
}
