<?php

namespace App\UseCases\Invoice\DeleteInvoice;

use Domain\Models\Invoice\Invoice;
use Domain\Models\Invoice\InvoiceRepository;

class DeleteInvoiceService
{
    // private InvoiceRepository $invoiceRepo;

    public function __construct(
        private InvoiceRepository $repo
    ) {
        // $this->invoiceRepo = $repo;
    }

    function delete(string $id): string
    {
        $invoice = $this->repo->getById($id);
        $this->repo->delete($id);
        return $id;
    }
}
