<?php
declare(strict_types=1);
namespace Domain\Models\Invoice;

// use Domain\Shared\Date;

class InvoiceService {

    /**
     * @param array<array{description:string, unit:float, quantity:int, currency:string}> $items
     */
    public static function addLineItems(Invoice $invoice, array $items){
        if (empty($items)) {
            throw new \InvalidArgumentException("Invoice must contain at least one line item.");
        }

        $lineItems = [];
        foreach ($items as $it) {
            $unit = Money::fromFloat((float)$it['amount'], $it['currency'] ?? 'INR');
            $invoice->addLineItem(new LineItem($it['id'], $it['name'], $it['hsn_code'], $unit, (int)$it['quantity']));
        }

    }
}
