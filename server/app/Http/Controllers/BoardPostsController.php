<?php

namespace App\Http\Controllers;

use App\Board;
use App\Http\Resources\PostResource;
use App\Http\Resources\BoardResource;

class BoardPostsController extends Controller
{
    /**
     * List resources from the storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(string $boardUrl)
    {
        $board = Board::where('url', $boardUrl)->orWhere('url_short', $boardUrl)->firstOrFail();

        return PostResource::collection($board->posts()->whereNull('parent_post_id')->paginate(50));
    }
}
