<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider {
    protected $policies = [];
    public function boot(): void {
        Gate::define('admin', fn(User $u)=>$u->role==='admin');
        Gate::define('worker', fn(User $u)=>$u->role==='worker');
    }
}
