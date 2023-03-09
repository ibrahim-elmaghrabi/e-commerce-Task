<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;
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
       return response()->json([
        'user'  => $user,
        'token' => $user->createToken("UserToken")->plainTextToken
       ], Response::HTTP_OK);
    }
}
