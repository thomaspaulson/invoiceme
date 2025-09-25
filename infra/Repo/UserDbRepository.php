<?php

namespace App\Infra\Repo;

use App\Domain\Models\User\User;
use App\Domain\Models\User\UserRepository;
use Illuminate\Support\Facades\DB;
use App\Infra\Lib\UuidGenerator;

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
