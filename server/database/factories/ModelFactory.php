<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Board;
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
