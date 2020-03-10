<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\Modules\Sales\Entities\SaleInfo::class, function (Faker $faker) {
    return [
        'product_id' => $faker->numberBetween(1, 5),//\Modules\Products\Entities\Product::all()->random()->id,
        'sale_id' => $faker->numberBetween(1, 5), //\Modules\Sales\Entities\SalesUserInfo::all()->random()->id,
        'buy_price' => $faker->numberBetween(1, 500),
        'count' => $faker->numberBetween(1, 50),
    ];
});
