<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\Contracts\LoginServiceInterface;
use App\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    private $loginService;

    public function __construct(LoginServiceInterface $loginService)
    {
        $this->loginService = $loginService;
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->loginService->login($request);
        return response()->json($result, $result['code']);
    }

    public function logout(Request $request): JsonResponse
    {
        $result = $this->loginService->logout($request);
        return response()->json($result, $result['code']);
    }
}
