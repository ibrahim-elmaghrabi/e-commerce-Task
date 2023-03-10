<?php

namespace App\Services\Auth;

use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\UserRepositoryContract;

class LoginService
{
    protected $userRepository ;

    public function __construct(UserRepositoryContract $userRepositoryContract)
    {
        $this->userRepository = $userRepositoryContract ;
    }

    public function login(array $data)
    {
        $user = $this->userRepository->whereFirst('email', $data['email']);
        if (!$user || !Hash::check($data['password'], $user->password))
        {
            return httpResponse(0, 'wrong credentials');
        }
        $token = $user->createToken('UserToken')->plainTextToken;
        return httpResponse(1, 'Success', ['token' => $token]);
    }
}