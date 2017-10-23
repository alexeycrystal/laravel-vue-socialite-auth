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
                ->waitFor('.panel-body')
                ->type('#name', 'Judge Dredd')
                ->type('#email', 'i.am.the.law@guilty.com')
                ->type('#password', 'password')
                ->type('#password-confirm', 'password')
                ->press('Register')
                ->pause(2000)
                ->assertPathIs('/#/')
                ->logout();

            $user = factory(User::class)->create([
                'name' => 'Pablo Escobar',
                'email' => 'narco.baron@cartel.com',
                'password' => Hash::make('cartelquertyl11')
            ]);

            $first->visit($appUrl . '/#/register')
                ->waitFor('.panel-body')
                ->type('#name', $user->name)
                ->type('#email', $user->email)
                ->type('#password', 'cartelquertyl11')
                ->type('#password-confirm', 'cartelquertyl11')
                ->press('Register')
                ->pause(2000)
                ->assertPathIs('/#/register')
                ->waitFor('.help-block')
                ->assertSee('The email has already been taken.');

            $first->visit($appUrl . '/#/register')
                ->waitFor('.panel-body')
                ->type('#name', 'Achilles Debussy')
                ->type('#email', 'iamthebest@tor.onion')
                ->type('#password', 'fightmeifyoucan')
                ->type('#password-confirm', 'dontfightmeifyoucan')
                ->press('Register')
                ->pause(2000)
                ->assertPathIs('/#/register')
                ->waitFor('.help-block')
                ->assertSee('The password confirmation does not match.');
        });
    }

    public function setUpTraits()
    {
        $this->backupDatabase();
        parent::setUpTraits();
    }
}
