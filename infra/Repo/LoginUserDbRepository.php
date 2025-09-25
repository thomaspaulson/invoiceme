<?php

namespace App\Infra\Repo;

use App\Application\UseCases\User\LoginUser\LoginUserRepository;
use App\Application\UseCases\User\LoginUser\User;
use App\Domain\Models\User\PasswordEncrypted;
use App\Domain\Models\User\UserNotFound;
use Illuminate\Support\Facades\DB;

class LoginUserDbRepository  implements LoginUserRepository
{

    public function getUserByEmail(string $email): User
    {
        $user = DB::table('users')
            ->select('id', 'name', 'email', 'password')
            ->where('email', $email)->first();

        if (!$user) {
            throw UserNotFound::withEmail($email);
        }

        return new User(
            $user->id,
            $user->name,
            $user->email,
            new PasswordEncrypted($user->password)
        );
    }
}
