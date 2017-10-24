<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\InitialiseDatabaseTrait;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class LoginTest extends DuskTestCase
{
    use InitialiseDatabaseTrait;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testLogin()
    {
        $this->browse(function ($first) {
            $appUrl = env("APP_URL", "http://localhost:8000");
            $user1 = factory(User::class)->create([
                'name' => 'Silvestr Stolovoy',
                'email' => 'rembo@firstblood.com',
                'password' => Hash::make('password')
            ]);

            $first->visit($appUrl . '/#/login')
                ->pause(2000)
                ->type('#email', $user1->email)
                ->type('#pass', 'password')
                ->press('Login')
                ->pause(2000)
                ->assertPathIs('/')
                ->clickLink('Logout');

            $first->visit($appUrl . '/#/login')
                ->pause(2000)
                ->type('#email', $user1->email)
                ->type('#pass', 'fakepassword')
                ->press('Login')
                ->pause(2000)
                ->assertPathIs('/')
                ->waitFor('.error__control')
                ->assertSee('Provided email and password does not match or not exists!');
        });
    }

    public function setUpTraits()
    {
        $this->backupDatabase();
        parent::setUpTraits();
    }
}