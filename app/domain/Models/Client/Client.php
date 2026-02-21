<?php

namespace Domain\Models\Client;

use Domain\Shared\Date;

class Client
{
    private function __construct(
        private string $id,
        private string $company,
        private string $firstName,
        private string $lastName,
        private string $email,
        private string $contact,
        private string $address,
        private Date $created,
        private Date $updated
    ) {
    }

    public static function create(
        string $id,
        string $company,
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
            $company,
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
        string $company,
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
            $company,
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
        string $company,
        string $firstName,
        string $lastName,
        string $email,
        string $contact,
        string $address,
        Date $updated
    ): void {
        $this->company = $company;
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
            'company' => $this->company,
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
