<?php

namespace Tests;

use Drfraker\SnipeMigrations\Snipe;
use Drfraker\SnipeMigrations\SnipeMigrations;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabaseState;

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
