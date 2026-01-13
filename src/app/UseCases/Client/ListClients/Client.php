<?php
declare(strict_types=1);
namespace App\UseCases\Client\ListClients;


class Client
{

    public function __construct(
        private string $id,
        private string $company,
        private string $firstName,
        private string $lastName,
        private string $email,
        private string $contact,
        private string $address
    ) {
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
        ];
    }
}
