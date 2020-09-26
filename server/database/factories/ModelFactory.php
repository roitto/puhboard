<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Board;
use App\Post;
use App\User;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(Board::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->word,
        'url' => $faker->unique()->word,
        'url_short' => $faker->unique()->randomletter,
        'description' => $faker->text(rand(10, 100)),
    ];
});

$factory->define(Post::class, function (Faker $faker) {
    return [
        'board_id' => factory(Board::class)->create(),
        'user_id' => factory(User::class)->create(),
        'parent_post_id' => null,
        'title' => $faker->text(rand(10, 50)),
        'content' => $faker->text(rand(10, 100)),
        'unique_identifier' => rand(1000, 9999),
        'user_ip' => $faker->ipv4,
    ];
});

$factory->afterCreatingState(Post::class, 'with_children', function ($post, $faker) {
    foreach (range(0, rand(1, 5)) as $i) {
        $post->children()->create([
            'board_id' => $post->board_id,
            'user_id' => factory(User::class)->create()->id,
            'parent_post_id' => $post->id,
            'title' => $faker->text(rand(10, 50)),
            'content' => $faker->text(rand(10, 100)),
            'unique_identifier' => rand(1000, 9999),
            'user_ip' => $faker->ipv4,
        ]);
    }
});
