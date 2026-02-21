<?php

namespace App\Events;

use Domain\Models\Invoice\InvoiceCreated;
use Psr\EventDispatcher\ListenerProviderInterface;

class LaravelListenerProvider implements ListenerProviderInterface
{
    public function getListenersForEvent(object $event): iterable
    {
        if ($event instanceof InvoiceCreated) {
            // You can use app() to resolve from container
            yield app(\App\Listeners\CreateInvoicePdf::class);
        }
    }
}
