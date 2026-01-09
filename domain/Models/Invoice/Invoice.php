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

    private array $taxes;

    private Date $created;

    private Date $updated;

    private function __construct(
        string $id,
        Client $client,
        Currency $currency,
        Date $created,
        Date $updated
    ) {

        $this->id = $id;
        $this->client = $client;

        $this->currency = $currency;
        $this->created = $created;
        $this->updated = $updated;

    }

    public function setItems(array $items): void
    {
        if (empty($items)) {
            throw new \InvalidArgumentException("Invoice must contain at least one line item.");
        }
        $this->items = $items;

    }

    public function items(): array
    {
        return array_map(fn($i) => $i->mappedData(), $this->items);
    }

    public function setTaxes(array $taxes){
        $this->taxes = $taxes;
    }

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

    public function taxSplit(): array {
        $amount = $this->taxAmount()->cents() / 2;
        return array_fill_keys($this->taxes, $amount);
    }

    public static function create(
        string $id,
        Client $client,
        Currency $currency,
        Date $created,
        Date $updated
    ): static {
       return new static(
        $id,
        $client,
        $currency,
        $created,
        $updated
       );
    }

    public static function fromDatabase(
        string $id,
        Client $client,
        Currency $currency,
        Date $created,
        Date $updated
    ): static {
        $invoice = new static(
            $id,
            $client,
            $currency,
            $created,
            $updated
        );
        return $invoice;
    }


    public function update(
        Client $client,
        array $items,
        Currency $currency,
        Date $updated
    ): void {
        $this->client = $client;
        $this->items = $items;
        $this->currency = $currency;
        $this->updated = $updated;
    }



    public function mappedData(): array
    {
        return [
            'id' => $this->id,
            'client' => json_encode($this->client->mappedData()),
            'amount' => $this->total()->cents(),
            'tax_amount' => $this->taxAmount()->cents(),
            'with_tax' => $this->withTax()->cents(),
            "taxes"=> json_encode($this->taxSplit()),
            'currency' => $this->currency->toString(),
            'created_at' => $this->created->asString(),
            'updated_at' => $this->updated->asString(),
        ];
    }

}
