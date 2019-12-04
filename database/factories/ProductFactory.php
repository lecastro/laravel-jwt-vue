<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'category_id' => 1,
        'name' => $faker->unique()->word,
        'descripition' => $faker->sentence(),
    ];
});
