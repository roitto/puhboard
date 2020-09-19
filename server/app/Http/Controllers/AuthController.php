<?php

namespace App\Http\Controllers;

use App\Http\Resources\AuthTokenResource;
use App\Http\Resources\ErrorResource;

class AuthController extends Controller
{
    /**
     * Auth login.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $data = $this->validate(request(), [
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        if (! $token = auth()->attempt($data)) {
            return (new ErrorResource((object) [
                'id' => '401',
                'status' => '401',
                'code' => 'unauthorized',
            ]))->response()->setStatusCode(401);
        }

        return new AuthTokenResource((object) [
            'token' => $token,
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }

    /**
     * Auth logout.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json([])->setStatusCode(204);
    }

    /**
     * Auth refresh token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return new AuthTokenResource((object) [
            'token' => auth()->refresh(),
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
