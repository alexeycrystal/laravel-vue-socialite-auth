<?php


namespace App\Services\Contracts;


interface SocialiteServiceInterface
{
    public function getRedirectUrlByProvider($provider): array;

    public function loginWithSocialite($provider): array;
}