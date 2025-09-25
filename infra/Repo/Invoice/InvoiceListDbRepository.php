<?php

namespace Infra\Repo\Invoice;

use App\UseCases\Invoice\ListInvoices\InvoiceListRepository;
use App\UseCases\Invoice\ListInvoices\Invoice;
use Illuminate\Support\Facades\DB;

class InvoiceListDbRepository implements InvoiceListRepository
{
    public function listInvoices(): array
    {
        $records = array_map(
            function ($r) {
                return new Invoice(
                    $r->id,
                    $r->firstName,
                    $r->lastName,
                    $r->email,
                    $r->contact,
                    $r->address,
                );
            },
            DB::table('invoices')->get()->toArray()
        );

        return $records;
    }
}
