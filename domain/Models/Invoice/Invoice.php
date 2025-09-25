<?php
declare(strict_types=1);
namespace Domain\Models\Invoice;

use Domain\Shared\Date;

class Invoice
{
    private string $id;

    private Client $client;

    /** @var LineItem[] */
    private array $items;

    private Money $total;

    private Money $tax;

    private Money $totalAfterTax;

    private Date $created;

    private Date $updated;

    private function __construct(
        string $id,
        Client $client,
        Date $created,
        Date $updated
    ) {
        $this->id = $id;
        $this->client = $client;
        $this->created = $created;
        $this->updated = $updated;
    }

    public function addLineItem(LineItem $it){
        $this->items[] = $it;
    }

    public static function create(
        string $id,
        Client $client,
        Date $created,
        Date $updated
    ): self {
       return new static(
        $id,
        $client,
        $created,
        $updated
       );
    }


    // public function toArray(): array {
    //     return [
    //         'id' => (string)$this->id,
    //         'number' => $this->number,
    //         'items' => array_map(fn($i) => $i->toArray(), $this->items),
    //         'total_cents' => $this->total->cents(),
    //         'currency' => $this->total->currency(),
    //         'created_at' => $this->createdAt->format('c')
    //     ];
    // }

}
