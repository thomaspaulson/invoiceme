<?php
declare(strict_types=1);
namespace App\UseCases\Client\UpdateClient;

class UpdateClient
{
    //
    public function __construct(
        private string $company,
        private string $firstName,
        private string $lastName,
        private string $email,
        private string $contact,
        private string $address
    ) {
    }


    public function company(): string
    {
        return $this->company;
    }


    public function firstName(): string
    {
        return $this->firstName;
    }

    public function lastName(): string
    {
        return $this->lastName;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function contact(): string
    {
        return $this->contact;
    }

    public function address(): string
    {
        return $this->address;
    }

    public static function fromRequestData(array $data): static
    {
        return new static(
            $data['company'],
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $data['contact'],
            $data['address']
        );
    }
}
