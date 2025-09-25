<?php

namespace App\UseCases\Vendor\ListVendors;


class Vendor
{

    private string $id;

    private string $firstName;

    private string $lastName;

    private string $email;

    private string $contact;

    private string $address;

    public function __construct(
        string $id,
        string $firstName,
        string $lastName,
        string $email,
        string $contact,
        string $address
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->contact = $contact;
        $this->address = $address;
    }

    public function id(): string
    {
        return $this->id;
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


    public function asArray(): array
    {
        return [
            // ...
            'id' => $this->id(),
            'firstName' => $this->firstName(),
            'lastName' => $this->lastName(),
            'email' => $this->email(),
            'contact' => $this->contact(),
            'address' => $this->address(),
        ];
    }
}
