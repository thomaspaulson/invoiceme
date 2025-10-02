<?php

namespace App\UseCases\Invoice\ShowInvoice;

class ShowInvoiceService
{
    // private ShowInvoiceRepository $showInvoiceRepo;

    public function __construct(
        private ShowInvoiceRepository $showInvoiceRepo
    ) {
        // $this->showInvoiceRepo = $repo;
    }

    function show(string $id): Invoice
    {
        $invoice = $this->showInvoiceRepo->viewInvoice($id);
        return $invoice;
    }
}
