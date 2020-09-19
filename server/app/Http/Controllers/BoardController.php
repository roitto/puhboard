<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Resources\BoardResource;

class BoardController extends Controller
{
    /**
     * List resources from the storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return BoardResource::collection(Board::where('is_hidden', false)->get());
    }
}
