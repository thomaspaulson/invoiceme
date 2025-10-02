<?php
declare(strict_types=1);
namespace Domain\Models\Invoice;

class Client
{
    private string $name;
    private string $address;
    private string $gstin;

    public function __construct(string $name, string $address, string $gstin)
    {
        $this->name = $name;
        $this->address = $address;
        $this->gstin = $gstin;
    }


    public function mappedData(): array {
        return [
            'name' => $this->name,
            'address' => $this->address,
            'gstin' => $this->gstin
        ];
    }
}
