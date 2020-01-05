<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Notification;
use Faker\Generator as Faker;
use Ramsey\Uuid\Uuid;

$factory->define(Notification::class, function (Faker $faker) {
    return [
        'id' => Uuid::uuid4()->toString(),
        'type' => 'App\Notifications\ThreadWasUpdated',
        'notifiable_id' => function () {
            return auth()->user()->id ?: factory('App\User')->create()->id;
        },
        'notifiable_type' => 'App\User',
        'data' => ['foo' => 'bar'],
    ];
});
