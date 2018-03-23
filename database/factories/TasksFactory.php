<?php

use Faker\Generator as Faker;

/**
 * Генерируем новости
 *
 * @var \Faker\Generator $faker
 */
$factory->define(App\Tasks::class, function (Faker $faker) {
    return [
        'user_id' => function () {
            return App\User::inRandomOrder()->pluck('id')->first();
        },
        'title' => $faker->realText(100),
        'body' => $faker->realText(2000),
    ];
});
