<?php

namespace Domain\Models\User;

use Domain\Shared\Date;

class User
{
    private string $id;

    private string $name;

    private string $email;

    private PasswordEncrypted $password;

    private Date $created;

    private Date $updated;

    private function __construct(
        string $id,
        string $name,
        string $email,
        PasswordEncrypted $password,
        Date $created,
        Date $updated
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->created = $created;
        $this->updated = $updated;
    }

    public static function create(
        string $id,
        string $name,
        string $email,
        string $password,
        Date $created,
        Date $updated
    ): self {
        $user = new self(
            $id,
            $name,
            $email,
            new PasswordEncrypted($password),
            $created,
            $updated
        );
        return $user;
    }

    public function mappedData(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password->password(),
            'created_at' => $this->created->asString(),
            'updated_at' => $this->updated->asString(),
            // ...
        ];
    }
}
