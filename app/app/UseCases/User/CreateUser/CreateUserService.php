<?php
declare(strict_types=1);
namespace App\UseCases\User\CreateUser;

use Domain\Models\User\Hashing;
use Domain\Models\User\User;
use Domain\Models\User\UserRepository;
use Domain\Shared\Clock;
use Domain\Shared\Date;

class CreateUserService
{
    private Clock $clock;

    private UserRepository $userRepo;

    private Hashing $hashing;

    public function __construct(
        UserRepository $repo,
        Hashing $hashing,
        Clock $clock
    ) {
        $this->userRepo = $repo;
        $this->hashing = $hashing;
        $this->clock = $clock;
    }

    function create(CreateUser $createUser): string
    {
        $userId = $this->userRepo->uuid();
        $created = $updated = Date::fromCurrentTime($this->clock->currentTime());
        $user = User::create(
            $userId,
            $createUser->name(),
            $createUser->email(),
            $this->hashing->encrypt($createUser->password()),
            $created,
            $updated
        );
        //insert user
        $this->userRepo->create($user);
        return $userId;
    }
}
