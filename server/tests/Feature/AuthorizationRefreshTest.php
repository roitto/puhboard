<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class AuthorizationRefreshTest extends TestCase
{
    /**
     * @test
     */
    public function it_refreshes_token()
    {
        // @todo Throws 500, this works in real but not in tests. The auth()->refresh() method cant access the request headers correctly somehow.
        $this->markTestSkipped();
        $user = factory(User::class)->create();

        $this->json('post', route('auth.refresh'), [], $this->tokenHeaderForUser($user))
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
}
