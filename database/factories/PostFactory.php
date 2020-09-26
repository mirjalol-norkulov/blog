<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
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

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->realText($maxNbChars = 20),
        'content' => $faker->realText($maxNbChars = 512),
        'image' => $faker->imageUrl($width = 1920, $height = 1080),
        'slug' => $faker->slug,
        'author_id' => 2
    ];
});
