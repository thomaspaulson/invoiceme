<?php
declare(strict_types=1);
namespace Domain\Models\Invoice;

use Domain\Shared\Money;
use Domain\Shared\Currency;

class InvoiceService {

    public static function createLineItems(array $items, array $hsnCodes, array $taxCodes): array {
        $lineItems = [];
        foreach ($items as $it) {
            $hsnCode = $it['hsn_code'];
            if(!in_array($hsnCode, array_keys($hsnCodes))){
                throw new InvalidHsnCode("Invalid hsn code");
            }
            $taxCode = $hsnCodes[$hsnCode];
            $tax = $taxCodes[$taxCode];
            $unit = Money::fromFloat((float)$it['amount'], new Currency($it['currency'] ?? 'INR'));
            $lineItems[] = new LineItem($it['id'], $it['name'], $hsnCode, $unit, (int)$it['quantity'], $tax);
        }
        return $lineItems;
    }

    // /**
    //  * @param array<array{description:string, unit:float, quantity:int, currency:string}> $items
    //  */
    // public static function addLineItems(Invoice $invoice, array $items){
    //     if (empty($items)) {
    //         throw new \InvalidArgumentException("Invoice must contain at least one line item.");
    //     }

    //     $lineItems = [];
    //     foreach ($items as $it) {
    //         $unit = Money::fromFloat((float)$it['amount'], $it['currency'] ?? 'INR');
    //         $invoice->addLineItem(new LineItem($it['id'], $it['name'], $it['hsn_code'], $unit, (int)$it['quantity']));
    //     }

    // }

    // public static function create(string $id, Client $client, array $items){
    //     if (empty($items)) {
    //         throw new \InvalidArgumentException("Invoice must contain at least one line item.");
    //     }

    //     $lineItems = [];
    //     foreach ($items as $it) {
    //         $unit = Money::fromFloat((float)$it['unit'], $it['currency'] ?? 'INR');
    //         $lineItems[] = new LineItem($it['description'], $unit, (int)$it['quantity']);
    //     }

    //     return new Invoice(
    //         $id,
    //         $client
    //         $lineItems
    //     );
    // }

}
