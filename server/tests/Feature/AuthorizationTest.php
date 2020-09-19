<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthorizationTest extends TestCase
{
    /**
     * @test
     */
    public function it_logs_in()
    {
        factory(User::class)->create([
            'name' => 'FooBar',
            'password' => 'Testing',
        ]);

        $this->post(route('auth.login'), [
            'name' => 'FooBar',
            'password' => 'Testing',
        ])
        ->seeStatusCode(200)
        ->seeJson([
            'id' => (string) '1000',
            'type' => (string) 'authorization',
        ])
        ->seeJsonStructure(['data' => [
            'id',
            'type',
            'attributes' => [
                'token',
                'expires_in'
            ]
        ]]);
    }
}
