<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'             => $faker->title,
        'content'           => $faker->text,
        // 'image'             => $faker->imageUrl($width='200', $height='200', 'animals', true),
        'tag_category_id'   => rand(1, 7),
        'prefecture_id'     => rand(1, 47),
        'user_id'           => rand(1, 5),
        'gender'            => $faker->randomElement($array = ['オス', 'メス', '全て']),
        'recruit_status'    => $faker->randomElement($array = ['里親募集中', '里親決定', '募集終了']),
        'deadline_date'     => $faker->dateTimeBetween('now', '1year')->format('Y-m-d'),
    ];
});
