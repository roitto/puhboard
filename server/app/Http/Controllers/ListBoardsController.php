<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Resources\BoardResource;

class ListBoardsController extends Controller
{
    /**
     * List boards from the storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke()
    {
        return BoardResource::collection(Board::where('is_hidden', false)->get());
    }
}
