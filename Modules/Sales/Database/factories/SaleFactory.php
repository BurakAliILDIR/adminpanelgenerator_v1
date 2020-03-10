<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\Modules\Sales\Entities\Sale::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 3),//User::all()->random()->id,
    ];
});
