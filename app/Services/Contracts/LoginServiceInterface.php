<?php


namespace App\Services\Contracts;


use App\Http\Requests\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

interface LoginServiceInterface
{
    public function login(LoginRequest $request): array;

    public function logout(Request $request): array;
}