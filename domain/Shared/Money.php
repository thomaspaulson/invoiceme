<?php

namespace Domain\Shared;


final class Money
{
    private int $cents;
    private Currency $currency;

    public function __construct(int $cents, Currency $currency ) {
        if ($cents < 0) throw new \InvalidArgumentException("Money cannot be negative");
        $this->cents = $cents;
        $this->currency = $currency;
    }

    public static function fromFloat(float $amount, Currency $currency): static {
        return new static((int)round($amount * 100), $currency);
    }

    public function add(Money $other): Money {
        $this->assertSameCurrency($other);
        return new Money($this->cents + $other->cents, $this->currency);
    }

    private function assertSameCurrency(Money $other): void {
        if (!$this->currency->equals($other->currency)) {
            throw new \InvalidArgumentException("Currency mismatch");
        }
    }

    public function cents(): int {
        return $this->cents;
    }

    public function currency(): Currency {
        return $this->currency;
    }

    public function toFloat(): float {
        return round($this->cents / 100.0, 2);
    }

    public function format(): string {
        return sprintf("%s %s", $this->toFloat(), $this->currency()->toString());
    }
}
