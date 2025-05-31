<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\FootballMatch;
use App\Observers\FootballMatchObserver;

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
        
    }
}
