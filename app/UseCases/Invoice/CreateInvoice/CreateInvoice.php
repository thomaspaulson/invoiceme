<?php
declare(strict_types=1);
namespace App\UseCases\Invoice\CreateInvoice;


class CreateInvoice
{

    private string $name;

    private string $address;

    private string $gstin;

    private array $items;


    public function __construct(
        string $name,
        string $address,
        string $gstin,
        array $items
    ) {
        $this->name = $name;
        $this->address = $address;
        $this->gstin = $gstin;
        $this->items = $items;
    }


    public function name(): string
    {
        return $this->name;
    }

    public function address(): string
    {
        return $this->address;
    }

    public function gstin(): string
    {
        return $this->gstin;
    }

    public function items(): array
    {
        return $this->items;
    }

    public static function fromRequestData(array $data): static
    {
        return new static(
            $data['name'],
            $data['address'],
            $data['gstin'],
            $data['items']
        );
    }
}
