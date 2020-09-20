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

    /**
     * Display the specified resource from the storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $boardUrl)
    {
        $board = Board::with(['posts' => function($query) {
            return $query->whereNull('parent_post_id');
        }])->where('url', $boardUrl)->orWhere('url_short', $boardUrl)->firstOrFail();

        return new BoardResource($board);
    }
}
