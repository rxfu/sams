<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'xh' => $faker->regexify('[0-9]{12}'),
        'xm' => $faker->name,
        'card_type' => $faker->numberBetween(0, 1),
        'sfzjh' => $faker->unique()->regexify('[0-9]{17}[0-9|X]'),
        'xbm' => $faker->randomElement(['男', '女']),
        'mzm' => $faker->word,
        'dwh' => $faker->randomNumber(2, true),
        'department' => $faker->word,
        'zydm' => $faker->randomNumber(7, true),
        'major' => $faker->word,
        'dqszj' => $faker->year,
        'xz' => $faker->randomElement(['2', '4']),
        'sfzx' => $faker->numberBetween(0, 1),
        'sjly' => $faker->randomElement(['教务管理系统', '研究生管理系统']),
    ];
});
