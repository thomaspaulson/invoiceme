<?php
declare(strict_types=1);
namespace Domain\Models\Invoice;

use Domain\Shared\Currency;
use Domain\Shared\Date;
use Domain\Shared\Money;

class Invoice
{
    private string $id;

    private Client $client;

    /** @var LineItem[] */
    private array $items;

    private Currency $currency;

    /* todo */
    // private Money $total;

    /* todo */
    // private Money $tax;

    /* todo */
    // private Money $withTax;

    private Date $created;

    private Date $updated;

    private function __construct(
        string $id,
        Client $client,
        array $items,
        Currency $currency,
        Date $created,
        Date $updated
    ) {

        $this->id = $id;
        $this->client = $client;

        if (empty($items)) {
            throw new \InvalidArgumentException("Invoice must contain at least one line item.");
        }
        $this->items = $items;
        $this->currency = $currency;
        $this->created = $created;
        $this->updated = $updated;

    }

    // public function addItems(array $items){
    //     foreach ($items as $it) {
    //         $unit = Money::fromFloat((float)$it['amount'], new Currency($it['currency'] ?? 'INR'));
    //         $this->addLineItem(new LineItem($it['id'], $it['name'], $it['hsn_code'], $unit, (int)$it['quantity']));
    //     }

    //     $this->items[] = $it;
    // }

    // public function addLineItem(LineItem $it){
    //     $this->items[] = $it;
    // }

    public function total(): Money {
        $total = new Money(0, $this->currency);
        foreach ($this->items as $item) {
            $total = $total->add($item->total());
        }
        return $total;
    }

    public function taxAmount(): Money {
        $total = new Money(0, $this->currency);
        foreach ($this->items as $item) {
            $total = $total->add($item->taxAmount());
        }
        return $total;
    }


    public function withTax(): Money {
        $total = new Money(0, $this->currency);
        foreach ($this->items as $item) {
            $total = $total->add($item->withTax());
        }
        return $total;
    }

    public static function create(
        string $id,
        Client $client,
        array $items,
        Currency $currency,
        Date $created,
        Date $updated
    ): static {
       return new static(
        $id,
        $client,
        $items,
        $currency,
        $created,
        $updated
       );
    }

    public function mappedData(): array
    {
        return [
            'id' => $this->id,
            'client' => $this->client->mappedData(),
            'total' => $this->total()->cents(),
            'tax_amount' => $this->taxAmount()->cents(),
            'with_tax' => $this->withTax()->cents(),
            'currency' => $this->currency->toString(),
            'items' => array_map(fn($i) => $i->mappedData(), $this->items),
            'created_at' => $this->created->asString(),
            'updated_at' => $this->updated->asString(),
        ];
    }

}
