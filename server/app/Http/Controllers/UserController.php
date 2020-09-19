<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\User;

class UserController extends Controller
{
    /**
     * Store a new resource to the storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function create()
    {
        $data = $this->validate(request(), [
            'name' => 'required|string|unique:users|min:2',
            'email' => 'sometimes|email|unique:users',
            'password' => 'required|string|min:6',
            'password_repeat' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $data['name'],
            'password' => $data['password'],
            'email' => $data['email'] ?? null,
        ]);

        return (new UserResource((object) [
            'uuid' => $user->uuid,
            'name' => $user->name,
            'email' => $user->email,
        ]))->response()->setStatusCode(201);
    }
}
