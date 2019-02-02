<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Two\User as SocialiteUser;

class User extends Authenticatable
{
    use Notifiable;

    public function __construct(array $attributes = [],
                                SocialiteUser $socialiteUser = null)
    {
        parent::__construct($attributes);
        $socialiteUser === null
            ?: $this->prepareUserBySocialite($socialiteUser);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'api_token'
    ];

    public function hashPassword(string $password): User{
        $this->password = Hash::make($password);
        return $this;
    }

    public function revokeToken(): User{
        $this->api_token = null;
        return $this;
    }

    public function createToken(): User{
        $this->api_token = str_random(60);
        return $this;
    }

    private function prepareUserBySocialite($social): void
    {
        $this->name = $social->name;
        $this->email = $social->email;
        $this->hashPassword($social->email . $social->id);
        $this->createToken();
    }
}
