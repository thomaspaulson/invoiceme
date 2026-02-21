<?php

namespace Infra\Repo\Invoice;

use Domain\Models\Invoice\Client;
use Domain\Models\Invoice\Invoice;
use Domain\Models\Invoice\InvoiceNotFound;
use Domain\Models\Invoice\InvoiceRepository;
use Domain\Models\Invoice\LineItem;
use Domain\Shared\Currency;
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

            $this->insertIntoInvoiceItems($invoice);


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
            DB::table('invoice_items')->where('invoice_id', $id)->delete();
            $this->insertIntoInvoiceItems($invoice);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    function insertIntoInvoiceItems(Invoice $invoice){
        ['id' => $invoiceId, 'created_at' => $createdAt ] = $invoice->mappedData();
        $pdo = DB::getPdo();
        $query = "INSERT INTO invoice_items (invoice_id, name, hsn_code, quantity, rate, total, tax, tax_amount, with_tax, currency, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($query);

        foreach ($invoice->items() as $row) {
            $stmt->execute([
                $invoiceId,
                $row['name'],
                $row['hsn_code'],
                $row['quantity'],
                $row['rate'],
                $row['total'],
                $row['tax'],
                $row['tax_amount'],
                $row['with_tax'],
                $row['currency'],
                $createdAt
            ]);
        }
    }

    function getById(string $id): Invoice
    {
        $invoice = DB::table('invoices')
        ->where('id', $id)->first();

        if (!$invoice) {
            throw InvoiceNotFound::withId($id);
        }

        $clientJson = json_decode($invoice->client);
        $client = new Client($clientJson->name, $clientJson->address,$clientJson->gstin);
        return Invoice::fromDatabase(
            $invoice->id,
            $client,
            new Currency($invoice->currency),
            Date::fromString($invoice->created_at),
            Date::fromString($invoice->updated_at),
        );

    }

    function delete(string $id): void
    {
        try {
            DB::table('invoice_items')->where('invoice_id', $id)->delete();
            DB::table('invoices')->delete($id);
        } catch (\Exception $e) {
            throw $e;
        }
    }

}
