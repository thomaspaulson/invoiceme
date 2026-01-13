<?php
declare(strict_types=1);
namespace App\UseCases\Vendor\ShowVendor;

use Domain\Shared\Date;

class Vendor
{

    public function __construct(
        private string $id,
        private string $company,
        private string $firstName,
        private string $lastName,
        private string $email,
        private string $contact,
        private string $address,
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
            'company' => $this->company,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'contact' => $this->contact,
            'address' => $this->address,
            'createdAt' => $this->createdAt(),
            'updatedAt' => $this->updatedAt(),
        ];
    }
}
