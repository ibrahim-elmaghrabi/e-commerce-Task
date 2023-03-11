<?php

namespace App\Http\Controllers\Api\Auth;


use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryContract;

class LogoutController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryContract $userRepositoryContract)
    {
        $this->userRepository = $userRepositoryContract;
    }

    public function logout()
    {
         $this->userRepository->logout();
         return httpResponse(1, 'Logged out');
    }
}
