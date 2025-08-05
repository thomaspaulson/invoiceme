<?php

namespace App\Infra\Repo;

use App\Application\UseCases\User\LoginUser\LoginUserRepository;
use App\Domain\Models\User\User;
use App\Domain\Models\User\UserNotFound;
use App\Domain\Models\User\UserRepository;
// use App\Infra\ORM\User as UserDataModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Infra\Lib\UuidGenerator;

class UserOrmRepository implements UserRepository
{
    use UuidGenerator;

    function create(User $user): void
    {
        try {
            DB::table('users')->insert(
                $user->mappedData()
            );
        } catch (\Exception $e) {
            throw $e;
        }

        // $r = UserDataModel::create(
        //     $user->mappedData()
        // );
    }

    function update(User $user): void
    {
        // $r = UserDataModel::create(
        //     $user->mappedData()
        // );
    }

    // function uuid(): string
    // {
    //     return Str::uuid();
    // }
}
