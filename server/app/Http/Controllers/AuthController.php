<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthTokenResource;
use App\Http\Resources\ErrorResource;
use App\User;

class AuthController extends Controller
{
    /**
     * Auth login.
     *
     * @return void
     */
    public function login()
    {
        $data = $this->validate(request(), [
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (! $token = auth()->attempt($data)) {
            return new ErrorResource((object) [
                'id' => '401',
                'status' => '401',
                'code' => 'unauthorized',
            ]);
        }

        return new AuthTokenResource((object) [
            'token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    /**
     * Auth logout.
     *
     * @return void
     */
    public function logout()
    {
    }

    /**
     * Auth refresh token.
     *
     * @return void
     */
    public function refresh()
    {
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
