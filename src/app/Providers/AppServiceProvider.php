<?php

namespace App\Providers;

use App\UseCases\Invoice\ListInvoices\InvoiceListRepository;
use App\UseCases\Invoice\ShowInvoice\ShowInvoiceRepository;
use App\UseCases\Client\ListClients\ClientListRepository;
use App\UseCases\Client\ShowClient\ShowClientRepository;
use App\UseCases\Vendor\ListVendors\VendorListRepository;
use App\UseCases\Vendor\ShowVendor\ShowVendorRepository;
use Domain\Models\Invoice\InvoiceRepository;
use Domain\Models\Invoice\StoreRepository;
use Domain\Models\Invoice\TaxRepository;
use Domain\Models\Client\ClientRepository;
use Domain\Models\Vendor\VendorRepository;
use Domain\Shared\Clock;
use Infra\Lib\ClockUsingSystemClock;
use Infra\Lib\StoreConfigRepository;
use Infra\Lib\TaxConfigRepository;
use Infra\Repo\Invoice\InvoiceDbRepository;
use Infra\Repo\Invoice\InvoiceListDbRepository;
use Infra\Repo\Invoice\ShowInvoiceDbRepository;
use Infra\Repo\Client\ShowClientDbRepository;
use Infra\Repo\Client\ClientListDbRepository;
use Infra\Repo\Client\ClientDbRepository;
use Infra\Repo\Vendor\ShowVendorDbRepository;
use Infra\Repo\Vendor\VendorListDbRepository;
use Infra\Repo\Vendor\VendorDbRepository;
use Illuminate\Support\ServiceProvider;


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
        $this->app->bind(ShowClientRepository::class, ShowClientDbRepository::class);
        $this->app->bind(ClientListRepository::class, ClientListDbRepository::class);
        $this->app->bind(ClientRepository::class, ClientDbRepository::class);
        $this->app->bind(InvoiceRepository::class, InvoiceDbRepository::class);
        $this->app->bind(StoreRepository::class, StoreConfigRepository::class);
        $this->app->bind(TaxRepository::class, TaxConfigRepository::class);
        $this->app->bind(InvoiceListRepository::class, InvoiceListDbRepository::class);
        $this->app->bind(ShowInvoiceRepository::class, ShowInvoiceDbRepository::class);


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
