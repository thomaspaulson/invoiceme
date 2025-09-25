<?php

namespace Domain\Models\Invoice;


final class Money
{
    private int $cents;
    private string $currency;

    public function __construct(int $cents, string $currency = 'INR') {
        if ($cents < 0) throw new \InvalidArgumentException("Money cannot be negative");
        $this->cents = $cents;
        $this->currency = $currency;
    }

    public static function fromFloat(float $amount, string $currency='INR'): static {
        return new static((int)round($amount * 100), $currency);
    }

    public function add(Money $other): Money {
        $this->assertSameCurrency($other);
        return new Money($this->cents + $other->cents, $this->currency);
    }

    private function assertSameCurrency(Money $other): void {
        if ($this->currency !== $other->currency) {
            throw new \InvalidArgumentException("Currency mismatch");
        }
    }

    public function cents(): int {
        return $this->cents;
    }

    public function currency(): string {
        return $this->currency;
    }

    public function toFloat(): float {
        return $this->cents / 100.0;
    }
}
