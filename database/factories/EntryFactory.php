<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Entry;
use Faker\Generator as Faker;

$factory->define(Entry::class, function (Faker $faker) {
    return [
        'name' => $faker->unique()->name,
        'is_enable' => $faker->boolean,
    ];
});
