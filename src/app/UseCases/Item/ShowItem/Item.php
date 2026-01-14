<?php
declare(strict_types=1);
namespace App\UseCases\Item\ShowItem;
use Domain\Shared\Date;
use Domain\Shared\Money;

class Item
{

    public function __construct(
        private string $id,
        private string $name,
        private string $hsnCode,
        private Money $rate,
        private Date $createdAt,
        private Date $updatedAt
    ) {
    }


    public function rate(): Money
    {
        return $this->rate;
    }

    public function amount(): string
    {
        return $this->rate()->digits();
    }

    public function currency(): string
    {
        return $this->rate()->currency()->toString();
    }

    public function createdAt(): string
    {
        return $this->createdAt->asString();
    }

    public function updatedAt(): string
    {
        return $this->updatedAt->asString();
    }

    public function asArray(): array
    {
        return [
            // ...
            'id' => $this->id,
            'name' => $this->name,
            'hsn_code' => $this->hsnCode,
            'amount' => $this->amount(),
            'currency' => $this->currency(),
            'createdAt' => $this->createdAt(),
            'updatedAt' => $this->updatedAt(),
        ];
    }
}
