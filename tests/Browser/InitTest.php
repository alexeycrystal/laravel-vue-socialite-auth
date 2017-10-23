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
            $browser->visit('http://localhost:8000')
                ->assertSee('Laravel');
        });
    }
}
