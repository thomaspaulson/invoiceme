<?php

namespace Domain\Models\User;

interface Hashing
{
    function encrypt(string $password): string;

    function verifyPassword(PasswordEncrypted $passwordEncrypt, string $password): bool;
}
