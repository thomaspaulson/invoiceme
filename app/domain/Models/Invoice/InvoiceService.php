<?php
declare(strict_types=1);
namespace Domain\Models\Invoice;

use Domain\Shared\Money;
use Domain\Shared\Currency;
use InvalidArgumentException;

class InvoiceService {

    public static function createLineItems(array $items, array $hsnCodes, array $taxCodes): array {

        if (count($items) == 0) {
            throw new InvalidArgumentException('items can\'t be empty');
        }

        $lineItems = [];
        foreach ($items as $it) {
            $hsnCode = $it['hsn_code'];
            if(!in_array($hsnCode, array_keys($hsnCodes))){
                throw new InvalidHsnCode("Invalid hsn code");
            }
            $taxCode = $hsnCodes[$hsnCode];
            $tax = $taxCodes[$taxCode];
            $unit = Money::fromFloat((float)$it['rate'], new Currency($it['currency'] ?? 'INR'));
            $lineItems[] = new LineItem($it['id'], $it['name'], $hsnCode, $unit, (int)$it['quantity'], $tax);
        }
        return $lineItems;
    }

}
