<?php

namespace Domain\Models\Item;

use Domain\Shared\Currency;
use Domain\Shared\Date;
use Domain\Shared\Money;

class Item
{
    private function __construct(
        private string $id,
        private string $name,
        private string $hsnCode,
        private Money $rate,
        private Date $created,
        private Date $updated
    ) {
    }

    public static function create(
        string $id,
        string $name,
        string $hsnCode,
        float $amount,
        string $currency,
        Date $created,
        Date $updated
    ): static {
        $item = new static(
            $id,
            $name,
            $hsnCode,
            Money::fromFloat(floatval($amount), new Currency($currency)),
            $created,
            $updated
        );
        return $item;
    }

    public static function fromDatabase(
        string $id,
        string $name,
        string $hsnCode,
        float $amount,
        string $currency,
        Date $created,
        Date $updated
    ): static {
        $item = new static(
            $id,
            $name,
            $hsnCode,
            new Money($amount, new Currency($currency)),
            $created,
            $updated
        );
        return $item;
    }


    public function update(
        string $name,
        string $hsnCode,
        float $amount,
        string $currency,
        Date $updated
    ): void {
        $this->name = $name;
        $this->hsnCode = $hsnCode;
        $this->rate = Money::fromFloat($amount, new Currency($currency));
        $this->updated = $updated;
    }

    public function rate(): Money {
        return $this->rate;
    }



    public function mappedData(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'hsn_code' => $this->hsnCode,
            'amount' => $this->rate()->cents(),
            'currency' => $this->rate()->currency()->toString(),
            'created_at' => $this->created->asString(),
            'updated_at' => $this->updated->asString(),
        ];
    }

}
