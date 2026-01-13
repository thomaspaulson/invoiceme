<?php
declare(strict_types=1);
namespace App\UseCases\Item\UpdateItem;

class UpdateItem
{
    //
    public function __construct(
        private string $name,
        private string $hsnCode,
        private float $amount
    ) {
    }


    public function name(): string
    {
        return $this->name;
    }


    public function hsnCode(): string
    {
        return $this->hsnCode;
    }

    public function amount(): float
    {
        return $this->amount;
    }

    public static function fromRequestData(array $data): static
    {
        return new static(
            $data['name'],
            $data['hsn_code'],
            $data['amount']
        );
    }
}
