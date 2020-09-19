<?php

namespace Tests;

use Drfraker\SnipeMigrations\Snipe;
use Drfraker\SnipeMigrations\SnipeMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use DatabaseMigrations, SnipeMigrations, DatabaseTransactions;

    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    /*
    public function setUpTraits()
    {
        (new Snipe())->importSnapshot();
        RefreshDatabaseState::$migrated = true;

        parent::setUpTraits();
    }
    */
}
