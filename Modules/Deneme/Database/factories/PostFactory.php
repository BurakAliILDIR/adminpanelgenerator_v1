<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use Modules\Deneme\Entities\Deneme;
use Modules\Deneme\Entities\Post;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});
