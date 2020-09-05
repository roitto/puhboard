<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AuthorizationTest extends TestCase
{
    /**
     * @test
     */
    public function it_logs_in()
    {
        $user = factory(User::class)->create([
            'name' => 'FooBar',
            'password' => 'Testing',
        ]);

        $this->json('post', route('auth.login'), [
            'name' => $user->name,
            'password' => $user->password,
        ]);

        $this->response->assertStatus(200);

        $this->seeJson(
            [
            'id' => (string) '1000',
            'type' => (string) 'authorization',
            ]);
    }
}
