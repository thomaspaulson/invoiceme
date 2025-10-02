<?php

namespace App\UseCases\Invoice\ShowInvoice;

interface ShowInvoiceRepository
{
    public function viewInvoice(string $id): Invoice;
}
