<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // \App\Models\Model::class => \App\Policies\ModelPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('schedule-session', function (User $user) {
            return $user->role === 'therapist';
        });

        Gate::define('request-session', function (User $user) {
            return $user->role === 'patient';
        });

        Gate::define('book-session', function ($user) {
            return $user->role === 'patient';
        });
        
    }
}
