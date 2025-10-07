<?php
namespace App\Listeners;


use Domain\Models\Invoice\InvoiceCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class CreateInvoicePdf implements ShouldQueue
{
    public function __invoke(InvoiceCreated $event): void
    {
        echo "creating inv pdf: {$event->id}";
        Log::info("creating inv pdf: {$event->id}");
    }
}
