<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'             => $faker->word,
        'content'           => $faker->sentence,
        'tag_category_id'   => rand(1, 6),
        'user_id'           => rand(1, 5),
        'gender'            => $faker->randomElement($array = ['オス', 'メス', '不明']),
        'recruit_status'    => $faker->randomElement($array = ['里親募集中', '里親決定', '募集終了']),
        'deadline_date'     => $faker->dateTimeBetween('now', '1year')->format('Y-m-d'),
    ];
});
