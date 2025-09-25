<?php
declare(strict_types=1);
namespace Domain\Models\Invoice;

/*
name
hsnCode
qty
*/
final class LineItem
{
    private string $id;
    private string $name;
    private string $hsnCode;
    private Money $rate;
    private int $quantity;


    public function __construct(string $id, string $name, string $hsnCode, Money $rate, int $quantity) {
        $this->id = $id;
        if ($quantity <= 0) throw new \InvalidArgumentException("Quantity must be > 0");
        $this->name = $name;
        $this->hsnCode = $hsnCode;
        $this->rate = $rate;
        $this->quantity = $quantity;
    }

    public function total(): Money {
        return new Money($this->rate->cents() * $this->quantity, $this->rate->currency());
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'invoice_id' => $this->invoiceId,
            'name' => $this->name,
            'rate' => $this->rate->cents(),
            'currency' => $this->rate->currency(),
            'quantity' => $this->quantity,
        ];
    }

    public function name(): string {
        return $this->name;
    }

    public function rate(): Money {
        return $this->rate;
    }

    public function quantity(): int {
        return $this->quantity;
    }
}
