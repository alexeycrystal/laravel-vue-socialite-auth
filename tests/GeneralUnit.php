<?php

namespace Tests;

use Tests\TestCase;
use Tests\InitialiseDatabaseTrait;

abstract class GeneralUnit extends TestCase
{
    use InitialiseDatabaseTrait;

    public function setUp()
    {
        parent::setUp();
        $this->backupDatabase();
    }

    public function tearDown()
    {
        $this->clearDatabase();
        parent::tearDown();
    }
}