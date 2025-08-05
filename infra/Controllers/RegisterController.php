<?php

namespace App\Infra\Controllers;

use App\Http\Controllers\Controller;
use App\Infra\Repo\UserOrmRepository;
use App\Infra\Requests\UserRegisterRequest;
use App\Application\UseCases\User\CreateUser\CreateUser;
use App\Application\UseCases\User\CreateUser\CreateUserService;
use App\Infra\Lib\ClockUsingSystemClock;
use App\Infra\Lib\HashingService;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(UserRegisterRequest $request)
    {
        $createUser = CreateUser::fromRequestData($request->all());
        $userId = (new CreateUserService(
            new UserOrmRepository(),
            new HashingService(),
            new ClockUsingSystemClock()
        ))
            ->create($createUser);
        $token = User::find($userId)->createToken(time());
        return ['token' => $token->plainTextToken];
    }
}
