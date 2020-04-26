<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Reply;
use Faker\Generator as Faker;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'thread_id' => factory('App\Thread'),
        'user_id' => factory('App\User'),
        'body' => $faker->paragraph,
    ];
});
