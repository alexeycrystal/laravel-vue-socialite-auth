<?php

namespace Tests;

use DatabaseSeeder;

trait InitialiseDatabaseTrait
{
    protected static $backupExtension = '.dusk.bak';

    /**
     * Creates an empty database for testing, but backups the current dev one first.
     */
    public function backupDatabase()
    {
        $this->refreshApplication();

        $db = $this->app->make('db')->connection();
        if (!file_exists($db->getDatabaseName())) {
            touch($db->getDatabaseName());
        } else {
            unlink($db->getDatabaseName());
            touch($db->getDatabaseName());
        }
        $db = $this->app->make('db')->connection();

        $this->artisan('migrate', ['--env' => 'dusk.local']);
        $this->app->make('db')->disconnect();
        $this->beforeApplicationDestroyed([$this, 'restoreDatabase']);
    }

    public function restoreDatabase()
    {
        $this->app->make('db')->disconnect();
    }
}