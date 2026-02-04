<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        return $this->authService->register($data);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();
        return $this->authService->login($data);
    }

    public function tokenLogin(LoginRequest $request)
    {
        $data = $request->validated();

        return $this->authService->tokenLogin($data);
    }

    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return response()->json([
            'message' => 'logged out succesfully'
        ]);
    }
}
