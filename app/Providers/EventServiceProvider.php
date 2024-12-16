<?php

namespace App\Providers;

use App\Events\Userlog;
use App\Listeners\LogListener;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    // public function register(): void
    // {
    //     //
    // }
    protected $listen = [
        UserLog::class => [
            LogListener::class,
        ],
    ];
    

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
