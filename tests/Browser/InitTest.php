<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class InitTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testInit()
    {
        $this->browse(function (Browser $browser) {
            $appUrl = env("APP_URL", "http://localhost:8000");
            $browser->visit($appUrl)
                ->assertSee('Login')
                ->assertSee('Register');
        });
    }
}
