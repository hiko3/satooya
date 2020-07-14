<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post_Prefecture;
use Faker\Generator as Faker;

$factory->define(Post_Prefecture::class, function (Faker $faker) {
    return [
        'post_id' => rand(1, 100),
        'prefecture_id' => rand(1, 47)
    ];
});
