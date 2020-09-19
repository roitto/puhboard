<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    /**
     * @test
     */
    public function it_creates_an_user()
    {
        $this->post(route('user.create'), [
            'name' => 'FooBar',
            'email' => 'Foo@example.test',
            'password' => 'Testing',
            'password_repeat' => 'Testing',
        ])
        ->seeStatusCode(201)
        ->seeJson([
            'type' => (string) 'user',
        ])
        ->seeJsonStructure(['data' => [
            'id',
            'type',
            'attributes' => [
                'name',
                'email',
                'settings',
            ],
        ]]);

        $this->seeInDatabase('users', [
            'name' => 'FooBar',
            'email' => 'Foo@example.test',
        ]);
    }

    /**
     * @test
     */
    public function name_is_required()
    {
        $this->post(route('user.create'), [
            'name' => '',
            'email' => 'Foo@example.test',
            'password' => 'Testing',
            'password_repeat' => 'Testing',
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

        $this->notSeeInDatabase('users', [
            'name' => '',
            'email' => 'Foo@example.test',
        ]);
    }

    /**
     * @test
     */
    public function name_is_must_be_unique()
    {
        factory(User::class)->create([
            'name' => 'FooBar',
            'password' => 'Testing',
        ]);

        $this->post(route('user.create'), [
            'name' => 'FooBar',
            'email' => 'Foo@example.test',
            'password' => 'Testing',
            'password_repeat' => 'Testing',
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
    public function name_length_must_be_longer_than_2()
    {
        $this->post(route('user.create'), [
            'name' => 'A',
            'email' => 'Foo@example.test',
            'password' => 'Testing',
            'password_repeat' => 'Testing',
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

        $this->notSeeInDatabase('users', [
            'name' => 'A',
            'email' => 'Foo@example.test',
        ]);
    }

    /**
     * @test
     */
    public function email_is_not_required()
    {
        $this->post(route('user.create'), [
            'name' => 'FooBar',
            'password' => 'Testing',
            'password_repeat' => 'Testing',
        ])
        ->seeStatusCode(201)
        ->seeJson([
            'type' => (string) 'user',
        ])
        ->seeJsonStructure(['data' => [
            'id',
            'type',
            'attributes' => [
                'name',
                'email',
                'settings',
            ],
        ]]);

        $this->seeInDatabase('users', [
            'name' => 'FooBar',
            'email' => null,
        ]);
    }

    /**
     * @test
     */
    public function email_must_be_valid_email()
    {
        $this->post(route('user.create'), [
            'name' => 'FooBar',
            'email' => 'Definetly_not_an_email',
            'password' => 'Testing',
            'password_repeat' => 'Testing',
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
                'email',
            ],
        ]]);

        $this->notSeeInDatabase('users', [
            'name' => 'FooBar',
            'email' => 'Definetly_no_an_email',
        ]);
    }

    /**
     * @test
     */
    public function email_must_be_unique()
    {
        factory(User::class)->create([
            'email' => 'FooBar@example.com',
        ]);

        $this->post(route('user.create'), [
            'name' => 'FooBar',
            'email' => 'FooBar@example.com',
            'password' => 'Testing',
            'password_repeat' => 'Testing',
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
                'email',
            ],
        ]]);
    }

    /**
     * @test
     */
    public function password_is_required()
    {
        $this->post(route('user.create'), [
            'name' => 'FooBar',
            'email' => 'FooBar@example.com',
            'password' => '',
            'password_repeat' => 'Testing',
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

        $this->notSeeInDatabase('users', [
            'name' => 'FooBar',
            'email' => 'FooBar@example.com',
        ]);
    }

    /**
     * @test
     */
    public function password_length_must_longer_than_6()
    {
        $this->post(route('user.create'), [
            'name' => 'FooBar',
            'email' => 'FooBar@example.com',
            'password' => '12345',
            'password_repeat' => '12345',
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

        $this->notSeeInDatabase('users', [
            'name' => 'FooBar',
            'email' => 'FooBar@example.com',
        ]);
    }

    /**
     * @test
     */
    public function password_repeat_is_required()
    {
        $this->post(route('user.create'), [
            'name' => 'FooBar',
            'email' => 'FooBar@example.com',
            'password' => 'Testing',
            'password_repeat' => '',
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
                'password_repeat',
            ],
        ]]);

        $this->notSeeInDatabase('users', [
            'name' => 'FooBar',
            'email' => 'FooBar@example.com',
        ]);
    }

    /**
     * @test
     */
    public function password_repeat_must_be_same_as_the_password()
    {
        $this->post(route('user.create'), [
            'name' => 'FooBar',
            'email' => 'FooBar@example.com',
            'password' => 'Testing',
            'password_repeat' => 'Not_same',
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
                'password_repeat',
            ],
        ]]);

        $this->notSeeInDatabase('users', [
            'name' => 'FooBar',
            'email' => 'FooBar@example.com',
        ]);
    }
}
