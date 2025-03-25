<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;


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
    public function boot()
{
    Gate::define('schedule-session', function (User $user) {
        return $user->role === 'therapist';
    });

    Gate::define('request-session', function (User $user) {
        return $user->role === 'patient';
    });
}

}
