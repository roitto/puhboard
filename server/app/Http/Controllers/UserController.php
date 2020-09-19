<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    /**
     * Store a new resource to the storage.
     *
     * @return void
     */
    public function create()
    {
        $data = $this->validate(request(), [
            'name' => 'required|string|unique:users',
            'email' => 'sometimes|email|unique:users',
            'password' => 'required|string',
            'password_second' => 'required|same_as:password',
        ]);
    }
}
