<?php
declare(strict_types=1);
namespace App\UseCases\Item\ListItems;


class Item
{

    public function __construct(
        private string $id,
        private string $name,
        private string $hsnCode,
        private float $amount
    ) {
    }



    public function asArray(): array
    {
        return [
            // ...
            'id' => $this->id,
            'name' => $this->name,
            'hsn_code' => $this->hsnCode,
            'amount' => $this->amount,
        ];
    }
}
