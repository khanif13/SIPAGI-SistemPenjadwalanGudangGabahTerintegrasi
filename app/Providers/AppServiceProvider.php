<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('create-gudang', function (User $user) {
            return $user->role_id === 1;
        });

        Gate::define('delete-gudang', function (User $user) {
            return $user->role_id === 1;
        });

        Gate::define('update-gudang', function (User $user) {
            return $user->role_id === 1 || $user->role_id === 2;
        });

        Gate::define('CRUD-role', function (User $user) {
            return $user->role_id === 1;
        });

        Gate::define('CRUD-stok', function (User $user) {
            return $user->role_id === 1 || $user->role_id === 2;
        });

        Gate::define('assign-manager', function (User $user) {
            return $user->role_id === 1;
        });

        Gate::define('create-jadwal', function (User $user) {
            return $user->role_id === 1 || $user->role_id === 3;
        });

        Gate::define('update-jadwal', function (User $user) {
            return $user->role_id === 1 || $user->role_id === 2;
        });

        Gate::define('delete-jadwal', function (User $user) {
            return $user->role_id === 1 || $user->role_id === 2 || $user->role_id === 3;
        });
    }
}
