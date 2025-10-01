<?php
declare(strict_types=1);
namespace Domain\Models\Invoice;

use Domain\Shared\Money;

final class LineItem
{
    private string $id;
    private string $name;
    private string $hsnCode;
    private Money $rate;
    private int $quantity;
    private int $tax;


    public function __construct(string $id, string $name, string $hsnCode, Money $rate, int $quantity, int $tax) {
        $this->id = $id;
        if ($quantity <= 0) throw new \InvalidArgumentException("Quantity must be > 0");
        $this->quantity = $quantity;
        $this->name = $name;
        $this->hsnCode = $hsnCode;
        $this->rate = $rate;
        $this->tax = $tax;
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

    public function taxPercent(): int {
        return $this->quantity;
    }

    public function total(): Money {
        return new Money($this->rate->cents() * $this->quantity, $this->rate->currency());
    }

    public function taxAmount(): Money {
        $taxAmount =  $this->total()->cents() * $this->tax / 100;
        return new Money($taxAmount, $this->rate()->currency());
    }

    public function withTax(): Money {
        return $this->total()->add($this->taxAmount());
    }


    public function mappedData(): array {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'rate' => $this->rate->cents(),
            'currency' => $this->rate->currency(),
            'quantity' => $this->quantity,
            'total' => $this->total(),
            'tax' => $this->tax,
            'taxAmount' => $this->taxAmount(),
            'withTax' => $this->withTax(),
        ];
    }

}
