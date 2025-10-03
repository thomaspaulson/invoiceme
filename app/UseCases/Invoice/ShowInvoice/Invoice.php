<?php
declare(strict_types=1);
namespace App\UseCases\Invoice\ShowInvoice;

use Domain\Models\Invoice\Client;
use Domain\Shared\Date;
use Domain\Shared\Money;

class Invoice
{

    public function __construct(
        private string $id,
        private Client $client,
        private Money $total,
        private Date $createdAt,
        private Date $updatedAt
    ) {
    }

    // public function id(): string
    // {
    //     return $this->id;
    // }

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

    public function updated(): string
    {
        return $this->updatedAt->asString();
    }

    public function asArray(): array
    {
        return [
            'id' => $this->id,
            'clientName' => $this->clientName(),
            'clientAddress' => $this->clientAddress(),
            'amount' => $this->amount(),
            'created' => $this->created(),
            'updated' => $this->updated(),
        ];
    }
}
