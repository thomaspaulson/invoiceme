<?php

namespace Domain\Models\Vendor;

use Domain\Shared\Date;

class Vendor
{
    private string $id;

    private string $firstName;

    private string $lastName;

    private string $email;

    private string $contact;

    private string $address;

    private Date $created;

    private Date $updated;

    private function __construct(
        string $id,
        string $firstName,
        string $lastName,
        string $email,
        string $contact,
        string $address,
        Date $created,
        Date $updated
    ) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->contact = $contact;
        $this->address = $address;
        $this->created = $created;
        $this->updated = $updated;
    }

    public static function create(
        string $id,
        string $firstName,
        string $lastName,
        string $email,
        string $contact,
        string $address,
        Date $created,
        Date $updated
    ): static {
        $user = new static(
            $id,
            $firstName,
            $lastName,
            $email,
            $contact,
            $address,
            $created,
            $updated
        );
        return $user;
    }

    public static function fromDatabase(
        string $id,
        string $firstName,
        string $lastName,
        string $email,
        string $contact,
        string $address,
        Date $created,
        Date $updated
    ): static {
        $user = new static(
            $id,
            $firstName,
            $lastName,
            $email,
            $contact,
            $address,
            $created,
            $updated
        );
        return $user;
    }


    public function update(
        string $firstName,
        string $lastName,
        string $email,
        string $contact,
        string $address,
        Date $updated
    ): void {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->contact = $contact;
        $this->address = $address;
        $this->updated = $updated;
    }


    public function mappedData(): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'email' => $this->email,
            'contact' => $this->contact,
            'address' => $this->address,
            'created_at' => $this->created->asString(),
            'updated_at' => $this->updated->asString(),
        ];
    }

}
