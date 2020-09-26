<?php

namespace Tests\Feature;

use App\Board;
use App\Post;
use Tests\TestCase;

class ShowBoardPostsTest extends TestCase
{
    /**
     * @test
     * @todo fix the way how to fetch the API using route name.
     */
    public function it_lists_boards_posts()
    {
        $board = factory(Board::class)->create();
        $posts = factory(Post::class, 5)->states('with_children')->create([
            'board_id' => $board->id,
        ]);

        $this->json('get', 'boards/'.$board->url)
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'data' => [[
                    'type',
                    'id',
                    'attributes',
                ]],
                'links',
                'meta',
            ]);

        $posts->each(function ($post) {
            $this->seeJson([
                'type' => 'post',
                'id' => (string) $post->id,
                'attributes' => [
                    'title' => (string) $post->title,
                    'content' => (string) $post->content,
                    'unique_identifier' => (string) $post->unique_identifier,
                    'bumped_at' => (string) $post->bumped_at,
                ],
            ]);
        });
    }
}
