<?php

namespace Tests;

use DatabaseSeeder;

trait InitialiseDatabaseTrait
{
    protected $databaseName;
    /**
     * Creates an empty database for testing, but backups the current dev one first.
     */
    public function backupDatabase()
    {
        $this->refreshApplication();

        $db = $this->app->make('db')->connection();
        $this->databaseName = $db->getDatabaseName();
        if (!file_exists($db->getDatabaseName())) {
            touch($db->getDatabaseName());
        } else {
            unlink($db->getDatabaseName());
            touch($db->getDatabaseName());
        }
        $db = $this->app->make('db')->connection();

        $this->artisan('migrate', ['--env' => 'dusk.local']);
        $this->app->make('db')->disconnect();
        $this->beforeApplicationDestroyed([$this, 'disconnectDatabase']);
    }

    public function disconnectDatabase()
    {
        $this->app->make('db')->disconnect();
    }

    public function clearDatabase(){
        file_put_contents($this->databaseName, '');
    }
}