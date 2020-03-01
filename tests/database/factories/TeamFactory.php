<?php

use Faker\Generator as Faker;
use KodeKeep\Livewired\Tests\User;
use KodeKeep\Teams\Models\Team;

$factory->define(Team::class, function (Faker $faker) {
    return [
        'owner_id' => factory(User::class),
        'name'     => $faker->unique()->firstName,
        'slug'     => $faker->slug,
    ];
});
