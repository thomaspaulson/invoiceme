<?php

namespace App\UseCases\Invoice\CreateInvoice;

use Domain\Models\Invoice\Client;
use Domain\Models\Invoice\Invoice;
use Domain\Models\Invoice\InvoiceRepository;
use Domain\Models\Invoice\InvoiceService;
use Domain\Shared\Clock;
use Domain\Shared\Date;

class CreateInvoiceService
{
    private InvoiceRepository $invoiceRepo;

    private Clock $clock;

    public function __construct(InvoiceRepository $repo, Clock $clock)
    {
        $this->invoiceRepo = $repo;
        $this->clock = $clock;
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

        $invoice = Invoice::create(
            $id,
            $client,
            $created,
            $updated
        );
        InvoiceService::addLineItems($invoice,$createInvoice->items());
        // insert Invoice into db
        dd($invoice);
        $this->invoiceRepo->create($invoice);

        return $id;
    }
}
