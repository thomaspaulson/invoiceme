<?php
declare(strict_types=1);
namespace App\UseCases\Invoice\ShowInvoice;

interface ShowInvoiceRepository
{
    public function viewInvoice(string $id): Invoice;
}
