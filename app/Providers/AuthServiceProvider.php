<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
// use Illuminate\Support\Facades\Gate;
use Auth;
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
        $this->registerPolicies();

        // Gate::define('eoffice-superadmin', function ($user=null) {
        //     return Auth::guard('officer')->check() && Auth::guard('officer')->user()->role_id == 1;
        // });

        // Gate::define('eoffice-user', function ($user=null) {
        //     return Auth::guard('officer')->check() && Auth::guard('officer')->user()->role_id == 2;
        // });

    }
}
