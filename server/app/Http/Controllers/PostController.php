<?php

namespace App\Http\Controllers;

use App\Post;
use App\Board;
use App\Http\Resources\BoardResource;

class PostController extends Controller
{
    /**
     * List resources from the storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Board $board, Post $post)
    {
        return BoardResource::collection(Board::where('is_hidden', false)->get());
    }
}
