<?php

namespace App\Providers;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Gate;
use Laravel\Horizon\Horizon;

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

    public function boot()
    {
        Horizon::auth(function ($request) {
            return true; // Permitir acceso a todos
        });
    }
    
    
}
