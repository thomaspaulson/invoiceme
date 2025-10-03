<?php
declare(strict_types=1);
namespace App\UseCases\User\LoginUser;

interface LoginUserRepository
{
    public function getUserByEmail(string $email): User;
}
