<?php

namespace App\Providers;

use App\UseCases\Vendor\ListVendors\VendorListRepository;
use App\UseCases\Vendor\ShowVendor\ShowVendorRepository;
use Domain\Models\Invoice\InvoiceRepository;
use Domain\Models\Invoice\StoreRepository;
use Domain\Models\Vendor\VendorRepository;
use Domain\Shared\Clock;
use Infra\Lib\ClockUsingSystemClock;
use Infra\Repo\Vendor\ShowVendorDbRepository;
use Infra\Repo\Vendor\VendorListDbRepository;
use Infra\Repo\Vendor\VendorDbRepository;
use Illuminate\Support\ServiceProvider;
use Infra\Lib\StoreConfigRepository;
use Infra\Repo\Invoice\InvoiceDbRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

        $this->app->bind(ShowVendorRepository::class, ShowVendorDbRepository::class);
        $this->app->bind(VendorListRepository::class, VendorListDbRepository::class);
        $this->app->bind(VendorRepository::class, VendorDbRepository::class);
        $this->app->bind(InvoiceRepository::class, InvoiceDbRepository::class);
        $this->app->bind(StoreRepository::class, StoreConfigRepository::class);

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
