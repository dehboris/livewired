<?php

use Faker\Generator as Faker;
use KodeKeep\NotificationMethods\Models\NotificationMethod;
use KodeKeep\Teams\Models\Team;

$factory->define(NotificationMethod::class, function (Faker $faker) {
    return [
        'notifiable_id'   => factory(Team::class),
        'notifiable_type' => Team::class,
        'name'            => $faker->unique()->firstName,
    ];
});

$factory->state(NotificationMethod::class, 'discord', function (Faker $faker) {
    return [
        'channel'     => 'discord',
        'discord_url' => $faker->url,
    ];
});

$factory->state(NotificationMethod::class, 'mail', function (Faker $faker) {
    return [
        'channel'      => 'mail',
        'mail_address' => $faker->safeEmail,
    ];
});

$factory->state(NotificationMethod::class, 'nexmo', function (Faker $faker) {
    return [
        'channel'          => 'nexmo',
        'nexmo_api_key'    => $faker->uuid,
        'nexmo_api_secret' => $faker->uuid,
        'nexmo_from'       => $faker->numberBetween(1, 100),
        'nexmo_to'         => $faker->numberBetween(1, 100),
    ];
});

$factory->state(NotificationMethod::class, 'pushbullet', function (Faker $faker) {
    return [
        'channel'          => 'pushbullet',
        'pushbullet_token' => $faker->uuid,
    ];
});

$factory->state(NotificationMethod::class, 'pushover', function (Faker $faker) {
    return [
        'channel'        => 'pushover',
        'pushover_token' => $faker->uuid,
        'pushover_user'  => $faker->uuid,
    ];
});

$factory->state(NotificationMethod::class, 'slack', function (Faker $faker) {
    return [
        'channel'   => 'slack',
        'slack_url' => $faker->url,
    ];
});

$factory->state(NotificationMethod::class, 'webhook', function (Faker $faker) {
    return [
        'channel'     => 'webhook',
        'webhook_url' => $faker->url,
    ];
});
