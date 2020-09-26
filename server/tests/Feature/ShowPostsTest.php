<?php

namespace Tests\Feature;

use App\Board;
use App\Post;
use Tests\TestCase;

class ShowPostsTest extends TestCase
{
    /**
     * @test
     * @todo fix the way how to fetch the API using route name.
     */
    public function it_lists_boards_posts()
    {
        $post = factory(Post::class)->states('with_children')->create();

        $this->json('get', 'posts/' . $post->id)
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'data' => [
                    'type',
                    'id',
                    'attributes' => [
                        'title',
                        'content',
                        'unique_identifier',
                        'bumped_at',
                        'children',
                    ],
                ],
            ])
            ->seeJson([
                'type' => 'post',
                'id' => (string) $post->id,
            ]);

        $post->children->each(function ($post) {
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
