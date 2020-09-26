<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostResource;
use App\Post;

class ShowPostsController extends Controller
{
    /**
     * List resources from the storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function __invoke(int $postId)
    {
        // @todo when the post is not a parent post, response with an url to the board/parent post where the post belongs to.
        return new PostResource(Post::whereNull('parent_post_id')->with('children')->findOrFail($postId));
    }
}
