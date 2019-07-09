<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Entry;
use Faker\Generator as Faker;

$factory->define(Entry::class, function (Faker $faker) {
    return [
        'company' => $faker->company,
        'subject_id' =>  $faker->biasedNumberBetween($min = 0, $max = 10),
        'anonymous' =>  $faker->boolean,
        'person' =>  $faker->unique()->safeEmail,
        'who' =>  $faker->name,
        'what' =>  $faker->sentence,
        'where' =>  $faker->address,
        'when' =>  $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = date_default_timezone_get()),
        'how' =>  $faker->sentence,
        'attachment_id' =>  $faker->biasedNumberBetween($min = 1, $max = 100),
        'why' =>  $faker->sentence,
        'already_done' =>  $faker->sentence,
        'agree' =>  $faker->boolean,
        'hash' =>  $faker->md5,
        'status_id' =>  $faker->biasedNumberBetween($min = 1, $max = 3),
        'created_at' =>  $faker->dateTimeBetween($startDate = '-3 years', $endDate = 'now', $timezone = date_default_timezone_get()),
    ];
});