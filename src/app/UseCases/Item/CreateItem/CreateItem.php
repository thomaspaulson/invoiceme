<?php
declare(strict_types=1);
namespace App\UseCases\Item\CreateItem;

use Domain\Shared\Currency;

class CreateItem
{

    public function __construct(
        private string $name,
        private string $hsnCode,
        private float $rate,
        private string $currency
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

    public function rate(): float
    {
        return $this->rate;
    }

    public function currency(): string
    {
        return $this->currency;
    }

    public static function fromRequestData(array $data): static
    {
        return new static(
            $data['name'],
            $data['hsn_code'],
            (float)$data['rate'],
            $data['currency'] ?? Currency::INR()->toString()
        );
    }
}
