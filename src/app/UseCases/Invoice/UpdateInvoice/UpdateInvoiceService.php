<?php
declare(strict_types=1);
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

    public function __construct(
        private InvoiceRepository $invoiceRepo,
        private TaxRepository $taxRepo,
        private Clock $clock
    ) {
    }

    function update(UpdateInvoice $updateInvoice, string $id): string
    {
        $updated = Date::fromCurrentTime($this->clock->currentTime());
        $invoice = $this->invoiceRepo->getById($id);
        $invoice->setTaxes($updateInvoice->taxes());

        $client = new Client(
            $updateInvoice->name(),
            $updateInvoice->address(),
            $updateInvoice->gstin()
        );

        ['hsncodes' => $hsnCodes, 'codes' => $taxCodes ] = $this->taxRepo->get();
        $items = InvoiceService::createLineItems($updateInvoice->items(), $hsnCodes, $taxCodes);

        $invoice->update(
            $client,
            $items,
            new Currency($items[0]->rate()->currency()->toString()),
            $updated
        );
        // update invoice
        $this->invoiceRepo->update($invoice, $id);
        return $id;
    }
}
