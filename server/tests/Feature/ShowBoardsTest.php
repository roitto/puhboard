<?php

namespace Tests\Feature;

use App\Board;
use Tests\TestCase;

class ShowBoardsTest extends TestCase
{
    /**
     * @test
     */
    public function it_lists_boards()
    {
        $boards = factory(Board::class, 4)->create();

        $this->json('get', route('boards.index'))
            ->seeStatusCode(200)
            ->seeJsonStructure([
                'data' => [[
                    'type',
                    'id',
                    'attributes',
                ]],
            ]);

        $boards->each(function ($board) {
            $this->seeJson([
                'type' => 'board',
                'id' => (string) $board->url,
                'attributes' => [
                    'name' => (string) $board->name,
                    'url' => (string) $board->url,
                    'url_short' => (string) $board->url_short,
                    'description' => (string) $board->description,
                    'icon' => (string) $board->icon,
                ],
            ]);
        });
    }
}
