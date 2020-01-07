<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Article;
use Faker\Generator as Faker;

$factory->define(Article::class, function (Faker $faker) {
    return [
        'title' => $faker->text(rand(20, 30)),
        'body' => $faker->paragraph(rand(5, 7), true)
    ];
});
