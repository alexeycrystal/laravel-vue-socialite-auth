<?php

namespace App\Http\Controllers;

use App\User;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
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
        //return Socialite::driver('facebook')->redirect();
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from social network e.t.c.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $userSocial = Socialite::driver($provider)->user();
        echo response()->json([
            'logMessage' => json_encode($userSocial)
        ]);

        /* Google
        $userSocial = Socialite::driver('google')->user();
        return $userSocial->token;
        */

        /*
         * FACEBOOK
        $findUser = User::where('email', $userSocial->email)->first();
        if ($findUser) {
            Auth::login($findUser);
            return 'Done with old!';
        } else {
            //return $userSocial->name;
            $user = New User;
            $user->name = $userSocial->name;
            $user->email = $userSocial->email;
            $user->password = bcrypt(1236345);
            $user->save();
            Auth::login($userSocial->email);
            return 'Done!';
        }
        */
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
