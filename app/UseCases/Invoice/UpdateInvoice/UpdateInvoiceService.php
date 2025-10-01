<?php

namespace App\UseCases\Invoice\UpdateInvoice;

use Domain\Models\Invoice\Client;
use Domain\Models\Invoice\Invoice;
use Domain\Models\Invoice\InvoiceRepository;
use Domain\Models\Invoice\InvoiceService;
use Domain\Models\Invoice\TaxRepository;
use Domain\Shared\Clock;
use Domain\Shared\Currency;
use Domain\Shared\Date;

class UpdateInvoiceService
{
    // private InvoiceRepository $invoiceRepo;

    // private TaxRepository $tax;

    // private Clock $clock;

    public function __construct(
        private InvoiceRepository $repo,
        private TaxRepository $tax,
        private Clock $clock
    ) {
        // $this->invoiceRepo = $repo;
        // $this->tax = $tax;
        // $this->clock = $clock;
    }

    function update(UpdateInvoice $updateInvoice, string $id): string
    {
        $updated = Date::fromCurrentTime($this->clock->currentTime());
        $invoice = $this->repo->getById($id);

        $client = new Client(
            $updateInvoice->name(),
            $updateInvoice->address(),
            $updateInvoice->gstin()
        );

        ['hsncodes' => $hsnCodes, 'codes' => $taxCodes ] = $this->tax->get();
        $items = InvoiceService::createLineItems($updateInvoice->items(), $hsnCodes, $taxCodes);

        $invoice->update(
            $client,
            $items,
            new Currency($items[0]->rate()->currency()->toString()),
            $updated
        );
        // update invoice
        $this->repo->update($invoice, $id);
        return $id;
    }
}
