<?php


namespace App\Services;


use App\Http\Requests\LoginRequest;
use App\Services\Contracts\LoginServiceInterface;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginService implements LoginServiceInterface
{
    public function login(LoginRequest $request): array
    {
        $errorResponse = [
            'error' => 'Provided email and password does not match or not exists!',
            'code' => 422
        ];
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password])) {
            $user = auth()->user();
            return $user->createToken()->save()
                ? [
                    'authenticated' => true,
                    'api_token' => $user->api_token,
                    'user_id' => $user->id,
                    'code' => 200]
                : $errorResponse;
        }
        return $errorResponse;
    }

    public function logout(Request $request): array
    {
        return auth()->user()->revokeToken()->save()
            ? ['logged_out' => true, 'code' => 200]
            : ['error' => 'Error occurs', 'code' => 409];
    }
}