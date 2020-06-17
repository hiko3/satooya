<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'             => $faker->title,
        'content'           => $faker->text,
        'tag_category_id'   => rand(1, 5),
        'user_id'           => rand(1, 5),
    ];
});
