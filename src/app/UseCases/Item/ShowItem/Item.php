<?php
declare(strict_types=1);
namespace App\UseCases\Item\ShowItem;
use Domain\Shared\Date;

class Item
{

    public function __construct(
        private string $id,
        private string $name,
        private string $hsnCode,
        private float $amount,
        private Date $createdAt,
        private Date $updatedAt
    ) {
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
            'amount' => $this->amount,
            'createdAt' => $this->createdAt(),
            'updatedAt' => $this->updatedAt(),
        ];
    }
}
