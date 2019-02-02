<?php


namespace App\Helpers;


use Illuminate\Support\Facades\Hash;

class SocialiteHelper
{
    public static function isSocialPresent($socialiteUser): bool{
        return $socialiteUser
            && isset($socialiteUser->email)
            && isset($socialiteUser->id);
    }

    public static function compareUserWithSocialite($user, $socialiteUser){
        return Hash::check(
            $socialiteUser->email . $socialiteUser->id,
            $user->password
        );
    }
}