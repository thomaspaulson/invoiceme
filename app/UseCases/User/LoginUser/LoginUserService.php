<?php
declare(strict_types=1);
namespace App\UseCases\User\LoginUser;

use Domain\Models\User\Hashing;

class LoginUserService
{
    private LoginUserRepository $loginRepo;

    private Hashing $hashing;

    public function __construct(LoginUserRepository $repo, Hashing $hashing)
    {
        $this->loginRepo = $repo;
        $this->hashing = $hashing;
    }

    function login(LoginUser $loginUser): User
    {
        $user = $this->loginRepo->getUserByEmail($loginUser->email());

        if ($this->hashing->verifyPassword($user->password(), $loginUser->password())) {
            return $user;
        }
    }
}
