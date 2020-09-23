<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Major;
use App\Models\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    $major = Major::inRandomOrder()->first();

    return [
        'id' => $faker->regexify('[0-9]{12}'),
        'name' => $faker->name,
        'card_type' => $faker->numberBetween(0, 1),
        'card_id' => $faker->unique()->regexify('[0-9]{17}[0-9X]'),
        'gender' => $faker->randomElement(['男', '女']),
        'nation' => $faker->word,
        'department_id' => $major->department_id,
        'major_id' => $major->id,
        'grade' => $faker->year,
        'duration' => $faker->randomElement(['2', '4']),
        'status' => $faker->numberBetween(0, 1),
        'level' => $faker->randomElement(['0', '1']),
    ];
});
