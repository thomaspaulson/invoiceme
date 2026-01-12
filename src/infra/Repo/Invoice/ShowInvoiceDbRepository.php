<?php

namespace Infra\Repo\Invoice;

use App\UseCases\Invoice\ShowInvoice\ShowInvoiceRepository;
use App\UseCases\Invoice\ShowInvoice\Invoice;
use Domain\Models\Invoice\Client;
use Domain\Models\Invoice\InvoiceNotFound;
use Domain\Shared\Currency;
use Illuminate\Support\Facades\DB;
use Domain\Shared\Date;
use Domain\Shared\Money;

class ShowInvoiceDbRepository implements ShowInvoiceRepository
{
    public function viewInvoice(string $id): Invoice
    {

        $invoice = DB::table('invoices')
        ->where('id', $id)->first();

        if (!$invoice) {
            throw InvoiceNotFound::withId($id);
        }

        $clientJson = json_decode($invoice->client);
        $client = new Client($clientJson->name, $clientJson->address, $clientJson->gstin);

        return new Invoice(
            $invoice->id,
            $client,
            new Money($invoice->with_tax, new Currency($invoice->currency)),
            Date::fromString($invoice->created_at),
            Date::fromString($invoice->updated_at),
        );

    }
}
