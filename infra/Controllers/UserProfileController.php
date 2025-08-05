<?php

namespace App\Infra\Controllers;

use App\Http\Controllers\Controller;
use App\Infra\Repo\UserOrmRepository;
use App\Infra\ORM\User as ORMUser;
use App\Application\UseCases\User\CreateUser\CreateUser;
use App\Application\UseCases\User\CreateUser\CreateUserService;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function me(Request $request)
    {
        $createUser = CreateUser::fromRequestData($request->all());
        $userId = $request->id;

        $userId = (new CreateUserService(new UserOrmRepository()))->create($createUser);
        $token = ORMUser::find($userId)->createToken(time());
        return ['token' => $token->plainTextToken];
    }
}
