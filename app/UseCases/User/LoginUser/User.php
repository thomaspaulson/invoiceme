<?php

namespace App\Application\UseCases\User\LoginUser;

use App\Domain\Models\User\PasswordEncrypted;

class User
{
    private string $id;

    private string $name;

    private string $email;

    private PasswordEncrypted $password;

    function __construct(
        string $id,
        string $name,
        string $email,
        PasswordEncrypted $password
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }


    public function id(): string
    {
        return $this->id;
    }


    public function name(): string
    {
        return $this->name;
    }

    public function email(): string
    {
        return $this->email;
    }

    public function password(): PasswordEncrypted
    {
        return $this->password;
    }
}
