<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\Deneme\Entities\Deneme;

$factory->define(\Modules\Deneme\Entities\DenemePost::class, function (Faker $faker) {
    return [
        'deneme_id' => $faker->numberBetween(10, 50),
        'post_id' => $faker->numberBetween(10, 50),
        'value' => $faker->name,
    ];
});
