<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SocialAuthTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testSocialAuth()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertVue('auth.user_id', null, )
                ->assertSee('Laravel');
        });
    }
}
