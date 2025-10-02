<?php

namespace App\UseCases\Invoice\CreateInvoice;

use Domain\Models\Invoice\Client;
use Domain\Models\Invoice\Invoice;
use Domain\Models\Invoice\InvoiceRepository;
use Domain\Models\Invoice\InvoiceService;
use Domain\Models\Invoice\StoreRepository;
use Domain\Models\Invoice\TaxRepository;
use Domain\Shared\Clock;
use Domain\Shared\Currency;
use Domain\Shared\Date;

class CreateInvoiceService
{
    public function __construct(
        private InvoiceRepository $invoiceRepo,
        private Clock $clock,
        private TaxRepository $tax
    ) {
    }

    function create(CreateInvoice $createInvoice): string
    {
        $id = $this->invoiceRepo->uuid();
        $created = $updated = Date::fromCurrentTime($this->clock->currentTime());
        $client = new Client(
            $createInvoice->name(),
            $createInvoice->address(),
            $createInvoice->gstin()
        );

        ['hsncodes' => $hsnCodes, 'codes' => $taxCodes ] = $this->tax->get();
        $items = InvoiceService::createLineItems($createInvoice->items(), $hsnCodes, $taxCodes);
        $invoice = Invoice::create(
            $id,
            $client,
            $items,
            new Currency('INR'),
            $created,
            $updated
        );
        $invoice->setTaxes($createInvoice->taxes());

        // insert Invoice into db
        $this->invoiceRepo->create($invoice);

        return $id;
    }
}
