<?php
declare(strict_types=1);
namespace App\UseCases\Item\CreateItem;

use Domain\Shared\Currency;

class CreateItem
{

    public function __construct(
        private string $name,
        private string $hsnCode,
        private float $amount,
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

    public function amount(): float
    {
        return $this->amount;
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
            (float)$data['amount'],
            $data['currency'] ?? Currency::INR()->toString()
        );
    }
}
