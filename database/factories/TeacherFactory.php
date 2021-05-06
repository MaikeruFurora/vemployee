<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Teacher;
use Faker\Generator as Faker;

$factory->define(Teacher::class, function (Faker $faker) {
    return [
        'fullname'=>$faker->name,
        'position'=>'Teacher '.$faker->randomElement($array = array ('I','II','III')),
        'dateEmployed'=>$faker->date($format = 'Y-m-d', $max = 'now'),
        'sex'=>$faker->randomElement($array = array ('Male','Female')),
        'dob'=>$faker->unique()->buildingNumber,
        'pob'=>$faker->unique()->buildingNumber,
        'employeeNumber'=>$faker->unique()->randomNumber($nbDigits = NULL, $strict = false),
        'station'=>$faker->unique()->buildingNumber,
        'civilStatus'=>$faker->randomElement($array = array ('Single','Marriage','Widow'))
    ];
});
