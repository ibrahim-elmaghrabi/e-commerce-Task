<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Requests\LoginRequest;
use App\Services\Auth\LoginService;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    protected $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request)
    {
        return $this->loginService->login($request->validated());
    }
}
