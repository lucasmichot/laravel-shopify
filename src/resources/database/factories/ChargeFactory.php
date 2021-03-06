<?php

use Faker\Generator as Faker;
use Illuminate\Support\Carbon;
use Osiset\ShopifyApp\Objects\Enums\ChargeStatus;
use Osiset\ShopifyApp\Objects\Enums\ChargeType;
use Osiset\ShopifyApp\Storage\Models\Charge;

$factory->define(Charge::class, function (Faker $faker) {
    return [
        'charge_id' => $faker->randomNumber(8),
        'name' => $faker->word,
        'price' => $faker->randomFloat(),
        'status' => ChargeStatus::ACCEPTED()->toNative(),
    ];
});

$factory->state(Charge::class, 'test', [
    'test' => true,
]);

$factory->state(Charge::class, 'type_recurring', [
    'type' => ChargeType::RECURRING()->toNative(),
]);

$factory->state(Charge::class, 'type_onetime', [
    'type' => ChargeType::CHARGE()->toNative(),
]);

$factory->state(Charge::class, 'type_usage', [
    'type' => ChargeType::USAGE()->toNative(),
]);

$factory->state(Charge::class, 'type_credit', [
    'type' => ChargeType::CREDIT()->toNative(),
]);

$factory->state(Charge::class, 'trial', function ($faker) {
    $days = $faker->numberBetween(7, 14);

    return [
        'trial_days' => $days,
        'trial_ends_on' => Carbon::today()->addDays($days),
    ];
});
