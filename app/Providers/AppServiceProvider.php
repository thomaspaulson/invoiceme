<?php

namespace App\Providers;

use App\UseCases\Vendor\ListVendors\VendorListRepository;
use App\UseCases\Vendor\ShowVendor\ShowVendorRepository;
use Domain\Models\Vendor\VendorRepository;
use Domain\Shared\Clock;
use Infra\Lib\ClockUsingSystemClock;
use Infra\Repo\Vendor\ShowVendorOrmRepository;
use Infra\Repo\Vendor\VendorListOrmRepository;
use Infra\Repo\Vendor\VendorOrmRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

        $this->app->bind(ShowVendorRepository::class, ShowVendorOrmRepository::class);
        $this->app->bind(VendorListRepository::class, VendorListOrmRepository::class);
        $this->app->bind(VendorRepository::class, VendorOrmRepository::class);
        $this->app->bind(Clock::class, ClockUsingSystemClock::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
