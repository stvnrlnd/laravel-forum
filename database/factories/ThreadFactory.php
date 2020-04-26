<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Thread;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Thread::class, function (Faker $faker) {
    $title = $faker->sentence;

    return [
        'user_id' => factory('App\User'),
        'channel_id' => factory('App\Channel'),
        'slug' => Str::slug($title),
        'title' => $title,
        'body' => $faker->paragraph,
        'visits' => 0,
    ];
});
