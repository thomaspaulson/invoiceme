<?php

namespace App\UseCases\Invoice\CreateInvoice;

use Domain\Models\Invoice\Client;
use Domain\Models\Invoice\Invoice;
use Domain\Models\Invoice\InvoiceRepository;
use Domain\Models\Invoice\InvoiceService;
use Domain\Models\Invoice\StoreRepository;
use Domain\Shared\Clock;
use Domain\Shared\Currency;
use Domain\Shared\Date;

class CreateInvoiceService
{
    private InvoiceRepository $invoiceRepo;

    private Clock $clock;

    private StoreRepository $store;

    public function __construct(InvoiceRepository $repo, Clock $clock, StoreRepository $store)
    {
        $this->invoiceRepo = $repo;
        $this->clock = $clock;
        $this->store = $store;
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
        $storeConfig = $this->store->get();
        ['hsncodes' => $hsnCodes,'taxes' => $taxes ] = $this->store->get();

        $items = InvoiceService::createLineItems($createInvoice->items(), $hsnCodes, $taxes);
        $invoice = Invoice::create(
            $id,
            $client,
            $items,
            new Currency('INR'),
            $created,
            $updated
        );
        // insert Invoice into db
        $this->invoiceRepo->create($invoice);

        return $id;
    }
}
