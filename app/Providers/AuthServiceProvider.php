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
        'App\Models\Pembelian' => 'App\Policies\PembelianPolicy',
        'App\Models\Penjualan' => 'App\Policies\PenjualanPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        Gate::before(function ($user) {
            return $user->isSuperAdmin() ? true : null;
        });

        Gate::define('super-admin', function ($user) {
            return $user->isSuperAdmin() ? true : null;
        });

        Gate::define('admin-only', function ($user) {
            return $user->isAdmin() ? true : null;
        });

        Gate::define('pabrikan-only', function ($user) {
            return $user->isPabrikan() ? true : null;
        });

        Gate::define('mitra-only', function ($user) {
            return $user->isMitra() ? true : null;
        });

        Gate::define('user-monitor', function ($user) {
            return $user->isUserMonitor() ? true : null;
        });
    }
}
