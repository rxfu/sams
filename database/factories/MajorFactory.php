<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Major;
use App\Models\Department;
use Faker\Generator as Faker;

$factory->define(Major::class, function (Faker $faker) {
    return [
        'id' => $faker->unique()->randomNumber(7, true),
        'name' => $faker->word,
        'is_enable' => $faker->numberBetween(0, 1),
        'department_id' => function () {
            return Department::inRandomOrder()->first()->id;
        }
    ];
});
