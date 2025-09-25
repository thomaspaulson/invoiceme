<?php

namespace Infra\Repo\Invoice;

use App\UseCases\Invoice\ShowInvoice\ShowInvoiceRepository;
use App\UseCases\Invoice\ShowInvoice\Invoice;
use Domain\Models\Invoice\InvoiceNotFound;
use Illuminate\Support\Facades\DB;
use Domain\Shared\Date;

class ShowInvoiceDbRepository implements ShowInvoiceRepository
{
    public function viewInvoice(string $id): Invoice
    {

        $invoice = DB::table('invoices')
        ->where('id', $id)->first();

        if (!$invoice) {
            throw InvoiceNotFound::withId($id);
        }

        return new Invoice(
            $invoice->id,
            $invoice->firstName,
            $invoice->lastName,
            $invoice->email,
            $invoice->contact,
            $invoice->address,
            Date::fromString($invoice->created_at),
            Date::fromString($invoice->updated_at),
        );

    }
}
