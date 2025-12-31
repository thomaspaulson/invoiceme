<?php

namespace App\Http\Controllers;

use Infra\Repo\UserDbRepository;
use App\Http\Requests\UserRegisterRequest;
use App\UseCases\User\CreateUser\CreateUser;
use App\UseCases\User\CreateUser\CreateUserService;
use Infra\Lib\ClockUsingSystemClock;
use Infra\Lib\HashingService;
use App\Models\User;

class RegisterController extends Controller
{
    public function index(UserRegisterRequest $request)
    {
        $createUser = CreateUser::fromRequestData($request->all());
        $userId = (new CreateUserService(
                    new UserDbRepository(),
                    new HashingService(),
                    new ClockUsingSystemClock()
                ))
                ->create($createUser);
        $token = User::find($userId)->createToken(time());
        return ['token' => $token->plainTextToken];
    }
}
