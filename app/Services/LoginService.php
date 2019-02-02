<?php


namespace App\Services;


use App\Http\Requests\LoginRequest;
use App\Services\Contracts\LoginServiceInterface;
use App\User;
use Illuminate\Http\Request;

class LoginService implements LoginServiceInterface
{
    public function login(LoginRequest $request): array
    {
        if (auth()->attempt($this->constructCredentials($request))) {
            $user = auth()->user();
            return $user->createToken()->save()
                ? $this->prepareSuccessResult($user)
                : $this->prepareErrorResult();
        }
        return $this->prepareErrorResult();
    }

    public function logout(Request $request): array
    {
        return auth()->user()->revokeToken()->save()
            ? ['logged_out' => true, 'code' => 200]
            : ['error' => 'Error occurs', 'code' => 409];
    }

    private function constructCredentials($request): array
    {
        return [
            'email' => $request->email,
            'password' => $request->password
        ];
    }

    private function prepareErrorResult(): array
    {
        return [
            'error' => 'Provided email and password does not match or not exists!',
            'code' => 422
        ];
    }

    private function prepareSuccessResult(User $user): array
    {
        return [
            'authenticated' => true,
            'api_token' => $user->api_token,
            'user_id' => $user->id,
            'code' => 200
        ];
    }
}