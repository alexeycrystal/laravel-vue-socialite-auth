<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Support\Facades\Hash;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\InitialiseDatabaseTrait;


class RegistrationTest extends DuskTestCase
{
    use InitialiseDatabaseTrait;

    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testRegistration()
    {
        $this->browse(function ($first) {
            $appUrl = env("APP_URL", "http://localhost:8000");

            $first->visit($appUrl . '/#/register')
                ->pause(2000)
                ->type('#name', 'Judge Dredd')
                ->type('#email', 'i.am.the.law@guilty.com')
                ->type('#pass', 'password')
                ->type('#passConfirm', 'password')
                ->press('Register')
                ->pause(2000)
                ->assertPathIs('/')
                ->pause(1500)
                ->clickLink('Logout');

            $user = factory(User::class)->create([
                'name' => 'Pablo Escobar',
                'email' => 'narco.baron@cartel.com',
                'password' => Hash::make('cartelquertyl11')
            ]);

            $first->visit($appUrl . '/#/register')
                ->pause(2000)
                ->type('#name', $user->name)
                ->type('#email', $user->email)
                ->type('#pass', 'cartelquertyl11')
                ->type('#passConfirm', 'cartelquertyl11')
                ->press('Register')
                ->pause(2000)
                ->assertPathIs('/')
                ->waitFor('.error__control')
                ->assertSee('The email has already been taken.');

            $first->visit($appUrl . '/#/register')
                ->pause(2000)
                ->type('#name', 'Achilles Debussy')
                ->type('#email', 'iamthebest@tor.onion')
                ->type('#pass', 'fightmeifyoucan')
                ->type('#passConfirm', 'dontfightmeifyoucan')
                ->press('Register')
                ->pause(2000)
                ->waitFor('.error__control')
                ->assertSee('The password confirmation does not match.');
        });
    }

    public function setUpTraits()
    {
        $this->backupDatabase();
        parent::setUpTraits();
    }
}
