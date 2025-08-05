<?php

namespace App\Application\UseCases\User\LoginUser;

interface LoginUserRepository
{
    public function getUserByEmail(string $email): User;
}
