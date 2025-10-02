<?php

namespace Infra\Repo\Invoice;

use App\UseCases\Invoice\ListInvoices\InvoiceListRepository;
use App\UseCases\Invoice\ListInvoices\Invoice;
use Domain\Models\Invoice\Client;
use Domain\Shared\Currency;
use Domain\Shared\Date;
use Domain\Shared\Money;
use Illuminate\Support\Facades\DB;

class InvoiceListDbRepository implements InvoiceListRepository
{
    public function listInvoices(): array
    {
        $records = array_map(
            function ($r) {
                $clientJson = json_decode($r->client);
                $client = new Client($clientJson->name, $clientJson->address,$clientJson->gstin);

                return new Invoice(
                    $r->id,
                    $client,
                    new Money($r->with_tax, new Currency($r->currency)),
                    Date::fromString($r->created_at)
                );
            },
            DB::table('invoices')->get()->toArray()
        );

        return $records;
    }
}
