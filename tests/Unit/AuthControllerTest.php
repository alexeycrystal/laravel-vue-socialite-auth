<?php

namespace Tests\Unit;

use Tests\GeneralUnit;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthControllerTest extends GeneralUnit
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testInitRoute()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testRedirectToProvider(){
        $provider = 'google';
        $this->json('GET',`/api/social/${provider}`)
            ->assertStatus(200)
            ->assertJsonStructure([
                'redirectUrl'
            ]);

        $provider = 'twitter';
        $this->json('GET',`/api/social/${provider}`)
            ->assertStatus(200)
            ->assertJsonStructure([
                'redirectUrl'
            ]);

        $provider = 'facebook';
        $this->json('GET',`/api/social/${provider}`)
            ->assertStatus(200)
            ->assertJsonStructure([
                'redirectUrl'
            ]);
    }

    public function testHandleProviderCallback(){
        $provider = 'google';
    }

    public function testRegistration(){
        $this->json('POST','/api/register',[
            'name' => 'Van Helsing',
            'email' => 'hunter.of.evil.spirits@vatican.com',
            'password' => 'saintwatergarlic111',
            'password_confirmation' => 'saintwatergarlic111'
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'registered',
                'api_token',
                'user_id'
            ]);
    }

    public function testLogin(){
        $this->json('POST','/api/register',[
            'name' => 'Carlo Gambino',
            'email' => 'king.of.the.volcano@cosanostra.com',
            'password' => 'sicilianboss111',
            'password_confirmation' => 'sicilianboss111'
        ]);
        $this->json('POST','/api/login',[
            'email' => 'king.of.the.volcano@cosanostra.com',
            'password' => 'sicilianboss111'
        ])
            ->assertStatus(200)
            ->assertJsonStructure([
                'authenticated',
                'api_token',
                'user_id'
            ]);
    }

    public function testLogout(){
        $this->json('POST','/api/logout')
            ->assertStatus(200)
            ->assertJsonStructure([
                'logged_out'
            ]);
    }
}
