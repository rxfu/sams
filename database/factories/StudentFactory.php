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
        'idtype' => $faker->numberBetween(0, 1),
        'idnumber' => $faker->unique()->regexify('[0-9]{17}[0-9X]'),
        'gender_id' => $faker->randomElement(['男', '女']),
        'nation_id' => $faker->word,
        'department_id' => $major->department_id,
        'major_id' => $major->id,
        'grade' => $faker->year,
        'duration' => $faker->randomElement(['2', '4']),
        'status' => $faker->numberBetween(0, 1),
        'level' => $faker->randomElement(['0', '1']),
    ];
});
