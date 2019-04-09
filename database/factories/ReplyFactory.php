<?php

use App\Model\Question;
use Faker\Generator as Faker;

$factory->define(App\Model\Reply::class, function (Faker $faker) {
    return [
        'body' => $faker->text(),
        'question_id' => function(){
        return Question::all()->random();
        },
        'user_id' => function(){
            return \App\User::all()->random();
        }
    ];
});
