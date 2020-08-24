<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Department;
use Faker\Generator as Faker;

$factory->define(Department::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomNumber(2, true),
        'name' => $faker->unique()->company,
        'is_enable' => $faker->numberBetween(0, 1),
    ];
});
