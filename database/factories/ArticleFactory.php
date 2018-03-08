<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Article::class, function (Faker $faker) {
    $sentence = $faker->sentence();

    $updated_at = $faker->dateTimeThisMonth();
    $created_at = $faker->dateTimeThisMonth();

    return [
        'title' => $sentence,
        'body' => $faker->text(),
        'excerpt' => $sentence,
        'created_at' => $created_at,
        'updated_at' => $updated_at,
    ];
});
