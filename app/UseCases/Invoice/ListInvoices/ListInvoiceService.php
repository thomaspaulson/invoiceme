<?php

namespace App\UseCases\Invoice\ListInvoices;

use App\UseCases\Invoice\ListInvoices\InvoiceListRepository;

class ListInvoiceService
{
    // private InvoiceListRepository $invoices;

    public function __construct(private  InvoiceListRepository $invoices)
    {
        // $this->invoices = $repo;
    }

    function list(): array
    {
        return $this->invoices->listInvoices();
    }
}
