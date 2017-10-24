<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Tests\InitialiseDatabaseTrait;

class SocialAuthTest extends DuskTestCase
{
    use InitialiseDatabaseTrait;

    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testSocialAuth()
    {

    }

    public function setUpTraits()
    {
        $this->backupDatabase();
        parent::setUpTraits();
    }
}
