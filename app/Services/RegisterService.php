<?php

namespace App\Services;


use App\Http\Requests\RegistrationRequest;
use App\Services\Contracts\RegisterServiceInterface;
use App\User;

class RegisterService implements RegisterServiceInterface
{

    public function register(RegistrationRequest $request): array
    {
        $errorResponse = [
            'error' => 'Provided email and password does not match or not exists!',
            'code' => 422
        ];
        $user = new User($request->all());
        return $user->createToken()
            ->hashPassword($request->password)
            ->save()
            ? [
                'registered' => true,
                'api_token' => $user->api_token,
                'user_id' => $user->id,
                'code' => 200]
            : $errorResponse;
    }

    public function registerBySocialite(): array
    {

    }
}