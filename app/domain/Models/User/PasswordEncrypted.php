<?php

namespace Domain\Models\User;

class PasswordEncrypted
{
    private string $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function password(): string
    {
        return $this->password;
    }
}
