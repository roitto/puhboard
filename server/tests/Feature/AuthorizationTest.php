<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

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
                'expires_in',
            ],
        ]]);
    }

    /**
     * @test
     */
    public function it_fails_with_wrong_credentials()
    {
        factory(User::class)->create([
            'name' => 'FooBar',
            'password' => 'Testing',
        ]);

        $this->post(route('auth.login'), [
            'name' => 'FooBar',
            'password' => 'WRONG_CREDS',
        ])
        ->seeStatusCode(401)
        ->seeJson([
            'id' => (string) '401',
            'status' => (string) '401',
            'code' => (string) 'unauthorized',
        ]);
    }

    /**
     * @test
     */
    public function name_is_required()
    {
        factory(User::class)->create([
            'name' => 'FooBar',
            'password' => 'Testing',
        ]);

        $this->post(route('auth.login'), [
            'name' => '',
            'password' => 'Testing',
        ])
        ->seeStatusCode(422)
        ->seeJson([
            'id' => (string) '422',
            'status' => (string) '422',
            'code' => (string) 'validation',
        ])
        ->seeJsonStructure(['errors' => [
            'id',
            'status',
            'code',
            'attributes' => [
                'name',
            ],
        ]]);
    }

    /**
     * @test
     */
    public function password_is_required()
    {
        factory(User::class)->create([
            'name' => 'FooBar',
            'password' => 'Testing',
        ]);

        $this->post(route('auth.login'), [
            'name' => 'FooBar',
            'password' => '',
        ])
        ->seeStatusCode(422)
        ->seeJson([
            'id' => (string) '422',
            'status' => (string) '422',
            'code' => (string) 'validation',
        ])
        ->seeJsonStructure(['errors' => [
            'id',
            'status',
            'code',
            'attributes' => [
                'password',
            ],
        ]]);
    }
}
