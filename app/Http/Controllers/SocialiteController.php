<?php

namespace App\Http\Controllers;

use App\Services\Contracts\SocialiteServiceInterface;
use Illuminate\Http\Response;



class SocialiteController extends Controller
{
    private $socialiteService;

    public function __construct(SocialiteServiceInterface $socialiteService)
    {
        $this->socialiteService = $socialiteService;
    }

    /**
     * Redirect the user to the social network authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return response()
            ->json($this->socialiteService
                ->getRedirectUrlByProvider($provider));
    }

    /**
     * Obtain the user information from social network
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $result = $this->socialiteService->loginWithSocialite($provider);
        return redirect($result['redirect_url'])
        ->withCookie($result['cookie']);
    }
}
