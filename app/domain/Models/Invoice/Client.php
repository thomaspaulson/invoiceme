<?php
declare(strict_types=1);
namespace Domain\Models\Invoice;

class Client
{

    public function __construct(
        private string $name,
        private string $address,
        private string $gstin)
    {

    }


    public function mappedData(): array {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'gstin' => $this->gstin
        ];
    }
}
