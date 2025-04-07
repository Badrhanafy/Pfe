<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Livewire\Livewire; // Add this import
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider2;
class AppServiceProvider extends ServiceProvider2
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        ////// last login handle : 
   
        parent::boot();
       
    
    Event::listen(Login::class, function ($event) {
        $event->user->update(['last_login_at' => now()]);
    });
    }
 
}
