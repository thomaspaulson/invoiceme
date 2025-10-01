<?php

namespace Infra\Repo\Invoice;

use Domain\Models\Invoice\Invoice;
use Domain\Models\Invoice\InvoiceNotFound;
use Domain\Models\Invoice\InvoiceRepository;
use Domain\Shared\Date;
use Illuminate\Support\Facades\DB;
use Infra\Lib\UuidGenerator;

class InvoiceDbRepository implements InvoiceRepository
{
    use UuidGenerator;

    function create(Invoice $invoice): void
    {
        try {
            dd($invoice->mappedData());
            DB::table('invoices')->insert(
                $invoice->mappedData()
            );

            DB::table('invoice_items')->insert(
                $invoice->mappedData()
            );


        } catch (\Exception $e) {
            throw $e;
        }
    }

    function update(Invoice $invoice, string $id): void
    {
        try {
            DB::table('invoices')
            ->where('id', $id)
            ->update(
                $invoice->mappedData()
            );
        } catch (\Exception $e) {
            throw $e;
        }
    }

    function getById(string $id): Invoice
    {
        $invoice = DB::table('invoices')
        ->where('id', $id)->first();

        if (!$invoice) {
            throw InvoiceNotFound::withId($id);
        }

        return Invoice::fromDatabase(
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

    function delete(string $id): void
    {
        try {
            DB::table('invoices')->delete($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
