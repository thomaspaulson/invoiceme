<?php

namespace App\Providers;

use App\Events\LaravelListenerProvider;
use App\Events\LaravelPsrEventDispatcher;
use App\Events\PsrEventDispatcher;
use Illuminate\Support\ServiceProvider;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;

class PsrEventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
        $this->app->bind(ListenerProviderInterface::class, LaravelListenerProvider::class);
        // $this->app->bind(EventDispatcherInterface::class, PsrEventDispatcher::class);
        $this->app->bind(EventDispatcherInterface::class, LaravelPsrEventDispatcher::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
