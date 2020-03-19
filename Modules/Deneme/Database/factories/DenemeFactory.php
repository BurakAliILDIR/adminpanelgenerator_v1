<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\Deneme\Entities\Deneme;

$factory->define(Deneme::class, function (Faker $faker) {
    return [
        'ad' => $faker->firstName,
        'soyad' => $faker->lastName,
        'durum' => $faker->boolean,
        'hakkimda' => $faker->text,
        'datee' => $faker->date(),
        'yas' => $faker->numberBetween(10, 50),
        'count_id' => $faker->numberBetween(1, 5),
        'dateetime' => $faker->dateTime,
    ];
});
