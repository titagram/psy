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
        $this->app->register(\Illuminate\Auth\AuthServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
{
    
}

}
