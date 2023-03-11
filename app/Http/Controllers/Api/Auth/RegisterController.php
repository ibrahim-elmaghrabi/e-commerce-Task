<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryContract;

class RegisterController extends Controller
{
    protected  $userRepository;

    public function __construct(UserRepositoryContract $userRepositoryContract)
    {
        $this->userRepository = $userRepositoryContract ;
    }

    public function register(UserRequest $request)
    {
       $user = $this->userRepository->create($request->validated());
       $token = $user->createToken("UserToken")->plainTextToken;
       return httpResponse(1, 'Success', ['token' => $token]);
    }
}
