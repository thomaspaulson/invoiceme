<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\UseCases\User\LoginUser\LoginUser;
use App\UseCases\User\LoginUser\LoginUserService;
use Domain\Models\User\InvalidPassword;
use Domain\Models\User\UserNotFound;
use Infra\Lib\HashingService;
use Infra\Repo\LoginUserDbRepository;
use App\Models\User;

class LoginController extends Controller
{
    public function index(UserLoginRequest $request)
    {
        try {
            $loginUser = LoginUser::fromRequestData($request->all());
            $user = (new LoginUserService(new LoginUserDbRepository(), new HashingService()))
                ->login($loginUser);

            if (!$user) {
                return ['user not found'];
            }

            $user = User::find($user->id());
            $token = $user->createToken(time());
            return response()->json([
                'token' => $token->plainTextToken,
                'user' => $user,
            ]);
        } catch (UserNotFound $exception) {
            return  response()->json([
                'error' => 'Email not found'
            ], 404);
        } catch (InvalidPassword $exception) {
            return  response()->json([
                'error' => 'Invalid credatials'
            ], 401);
        }
    }
}
