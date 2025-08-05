<?php

namespace Infra\Lib;

use Domain\Models\User\Hashing;
use Domain\Models\User\InvalidPassword;
use Domain\Models\User\PasswordEncrypted;

class HashingService implements Hashing
{
    public function encrypt(string $password): string
    {
        return sha1($password);
    }

    public function verifyPassword(PasswordEncrypted $passwordEncrypt, string $password): bool
    {
        if ($passwordEncrypt->password() == $this->encrypt($password)) {
            return true;
        }
        throw InvalidPassword::incorrectPassword();
    }
}
