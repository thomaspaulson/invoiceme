<?php
declare(strict_types=1);
namespace App\UseCases\Invoice\ShowInvoice;

class ShowInvoiceService
{

    public function __construct(
        private ShowInvoiceRepository $showInvoiceRepo
    ) {
    }

    function show(string $id): Invoice {
        $invoice = $this->showInvoiceRepo->viewInvoice($id);
        return $invoice;
    }
}
