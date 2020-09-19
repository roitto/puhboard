<?php

namespace Tests;

use Drfraker\SnipeMigrations\SnipeMigrations;
use Illuminate\Contracts\Auth\Authenticatable;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;
use Tymon\JWTAuth\Facades\JWTAuth;

abstract class TestCase extends BaseTestCase
{
    use DatabaseMigrations, SnipeMigrations, DatabaseTransactions;

    /**
     * Set an token header for the user.
     *
     * @param \Illuminate\Contracts\Auth\Authenticatable
     * @return array
     */
    public function tokenHeaderForUser(Authenticatable $user)
    {
        return [
            'Authorization' => 'Bearer '.JWTAuth::fromUser($user),
        ];
    }

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
