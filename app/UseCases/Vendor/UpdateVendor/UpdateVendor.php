<?php
declare(strict_types=1);
namespace App\UseCases\Vendor\UpdateVendor;

class UpdateVendor
{
    //
    private string $firstName;

    private string $lastName;

    private string $email;

    private string $contact;

    private string $address;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $contact,
        string $address
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->contact = $contact;
        $this->address = $address;
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
            $data['firstName'],
            $data['lastName'],
            $data['email'],
            $data['contact'],
            $data['address']
        );
    }
}
