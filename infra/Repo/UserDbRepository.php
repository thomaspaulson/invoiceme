<?php

namespace Infra\Repo;

use Domain\Models\User\User;
use Domain\Models\User\UserRepository;
use Illuminate\Support\Facades\DB;
use Infra\Lib\UuidGenerator;

class UserDbRepository implements UserRepository
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
    }

    function update(User $user): void
    {
        // $r = UserDataModel::create(
        //     $user->mappedData()
        // );
    }

}
