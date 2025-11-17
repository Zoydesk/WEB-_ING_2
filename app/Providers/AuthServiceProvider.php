<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [];

    public function boot(): void
    {
        Gate::define('admin', function (User $u) {
            return $u->role === 'admin';
        });

        Gate::define('worker', function (User $u) {
            return $u->role === 'worker';
        });
    }
}
