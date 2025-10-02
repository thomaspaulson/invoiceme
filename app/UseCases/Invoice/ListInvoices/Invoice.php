<?php

namespace App\UseCases\Invoice\ListInvoices;

use Domain\Models\Invoice\Client;
use Domain\Shared\Date;
use Domain\Shared\Money;

class Invoice
{

    public function __construct(
        private string $id,
        private Client $client,
        private Money $total,
        private Date $createdAt
    ) {
    }

    public function id(): string
    {
        return $this->id;
    }

    public function clientName(): string
    {
        ['name' => $name] = $this->client->mappedData();
        return $name;
    }

    public function clientAddress(): string
    {
        ['address' => $address] = $this->client->mappedData();
        return $address;
    }

    public function amount(): string
    {
        return $this->total->format();
    }

    public function created(): string
    {
        return $this->createdAt->asString();
    }

    public function asArray(): array
    {
        return [
            'id' => $this->id(),
            'clientName' => $this->clientName(),
            'clientAddress' => $this->clientAddress(),
            'amount' => $this->amount(),
            'created' => $this->created()
        ];
    }
}
