<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(Model::class, function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->sentence(2),
        'user_id' => function (){
            return factory(App\User::class)->create()->id;
        }
    ];
});
