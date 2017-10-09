<?php

namespace App\Http\Controllers;

use App\User;


use Illuminate\Http\Response;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    private const REDIRECT_DASHBOARD = '/#/';
    private const REDIRECT_LOGIN = '/#/login';

    public function __construct()
    {
        $this->middleware('auth:api')->only('logout');
    }

    /**
     * Redirect the user to the social network authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return response()->json([
            'redirectUrl' => Socialite::driver($provider)->stateless()->redirect()->getTargetUrl()
        ]);
    }

    /**
     * Obtain the user information from social network e.t.c.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $userSocial = Socialite::driver($provider)->stateless()->user();
        if ($userSocial && isset($userSocial->email) && isset($userSocial->id)) {
            $findUser = User::where('email', $userSocial->email)->first();
            if ($findUser) {
                if (Hash::check($userSocial->email . $userSocial->id, $findUser->password)) {
                    $findUser->api_token = str_random(60);
                    $findUser->save();
                    return redirect('/#/')->withCookie(cookie('authentication',
                        json_encode([
                            'api_token' => $findUser->api_token,
                            'user_id' => $findUser->id
                        ]), 8000, null, null, false, false));
                } else {
                    return redirect('/#/login')->withCookie(cookie('authentication', json_encode([
                            'error' => 'User is unavailable. Try another social account!',
                            'redirect' => '/login'
                        ]), 8000, null, null, false, false));
                }
            } else {
                $user = New User;
                $user->name = $userSocial->name;
                $user->email = $userSocial->email;
                $user->password = Hash::make($userSocial->email . $userSocial->id);
                $user->api_token = str_random(60);
                $user->save();
                return redirect('/#/')->withCookie(cookie('authentication',
                    json_encode([
                        'api_token' => $user->api_token,
                        'user_id' => $user->id
                    ]), 8000, null, null, false, false));
            }
        } else {
            return redirect('/#/login')->withCookie('authentication',
                json_encode([
                    'error' => 'User is unavailable or email field is empty. Try another social account!',
                    'redirect' => '/login'
                ]), 8000, null, null, false, false);
        }
    }

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|between:6,25|confirmed'
        ]);
        $user = new User($request->all());
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->api_token = str_random(60);
        $user->save();
        return response()->json([
            'registered' => true,
            'api_token' => $user->api_token,
            'user_id' => $user->id
        ]);
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|between:6,25'
        ]);
        $user = User::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            $user->api_token = str_random(60);
            $user->save();
            return response()->json([
                'authenticated' => true,
                'api_token' => $user->api_token,
                'user_id' => $user->id
            ]);
        }
        return response()->json([
            'error' => 'Provided email and password does not match or not exists!'
        ], 422);
    }

    public function logout(Request $request)
    {
        $user = $request->user();
        $user->api_token = null;
        $user->save();
        return response()->json([
            'logged_out' => true
        ]);
    }
}
