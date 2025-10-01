<?php

namespace Infra\Repo\Invoice;

use Domain\Models\Invoice\Client;
use Domain\Models\Invoice\Invoice;
use Domain\Models\Invoice\InvoiceNotFound;
use Domain\Models\Invoice\InvoiceRepository;
use Domain\Models\Invoice\LineItem;
use Domain\Shared\Date;
use Domain\Shared\Money;
use Illuminate\Support\Facades\DB;
use Infra\Lib\UuidGenerator;

class InvoiceDbRepository implements InvoiceRepository
{
    use UuidGenerator;

    function create(Invoice $invoice): void
    {
        try {
            DB::table('invoices')->insert(
                $invoice->mappedData()
            );

            ['id' => $invoiceId, 'created_at' => $createdAt ] = $invoice->mappedData();
            $pdo = DB::getPdo();
            $stmt = $pdo->prepare("INSERT INTO invoice_items (invoice_id, name, hsn_code, quantity, rate, tax_amount, with_tax, currency, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");

            foreach ($invoice->items() as $row) {
                $stmt->execute([$invoiceId, $row['name'], $row['hsn_code'], $row['quantity'], $row['rate'], $row['tax_amount'], $row['with_tax'], $row['currency'], $createdAt]);
            }

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

        $invoiceItems = DB::table('invoice_items')
        ->where('invoice_id', $id)->get();
        $items = [];
        foreach($invoiceItems as $it){
            $money = new Money($it->rate, $it->currency);
            $items[] = new LineItem($it->id, $it->name, $it->hsn_code, $money, $it->quantity, $it->tax);
        }

        $client = new Client($invoice->name, $invoice->address,$invoice->gstin);
        return Invoice::fromDatabase(
            $invoice->id,
            $client,
            $items,
            $invoice->currency,
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
