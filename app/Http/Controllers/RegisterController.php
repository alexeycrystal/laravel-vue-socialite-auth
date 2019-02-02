<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegistrationRequest;
use App\Services\Contracts\RegisterServiceInterface;
use App\User;

class RegisterController extends Controller
{
    private $registerService;

    public function __construct(RegisterServiceInterface $registerService)
    {
        $this->registerService = $registerService;
    }

    public function register(RegistrationRequest $request)
    {
        $result = $this->registerService->register($request);
        return response()->json($result, $result['code']);
    }
}
