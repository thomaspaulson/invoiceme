<?php

namespace App\Infra\Controllers;

use App\Http\Controllers\Controller;
use Infra\Requests\UserLoginRequest;
use App\UseCases\User\LoginUser\LoginUser;
use App\UseCases\User\LoginUser\LoginUserService;
use App\Domain\Models\User\InvalidPassword;
use App\Domain\Models\User\UserNotFound;
use Infra\Lib\HashingService;
use Infra\Repo\LoginUserOrmRepository;
use App\Models\User;

class LoginController extends Controller
{
    public function index(UserLoginRequest $request)
    {
        try {
            $loginUser = LoginUser::fromRequestData($request->all());
            $user = (new LoginUserService(new LoginUserOrmRepository(), new HashingService()))
                ->login($loginUser);

            if (!$user) {
                return ['user not found'];
            }

            $token = User::find($user->id())->createToken(time());
            return response()->json(['token' => $token->plainTextToken]);
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
